import makeWASocket, {
    useMultiFileAuthState,
    DisconnectReason,
    fetchLatestBaileysVersion,
} from '@whiskeysockets/baileys';
import express from 'express';
import pino from 'pino';
import qrcode from 'qrcode-terminal';
import { readFileSync, existsSync } from 'fs';
import { basename } from 'path';

const app = express();
app.use(express.json());

let sock = null;

async function conectarWhatsApp() {
    const { state, saveCreds } = await useMultiFileAuthState('./auth_info');
    const { version } = await fetchLatestBaileysVersion();

    sock = makeWASocket({
        version,
        auth: state,
        logger: pino({ level: 'silent' }),
        printQRInTerminal: false,
    });

    sock.ev.on('connection.update', ({ connection, lastDisconnect, qr }) => {
        if (qr) {
            console.log('\n=== Escanea este QR con WhatsApp del congreso ===');
            qrcode.generate(qr, { small: true });
            console.log('=================================================\n');
        }

        if (connection === 'close') {
            const codigo = lastDisconnect?.error?.output?.statusCode;
            const reconectar = codigo !== DisconnectReason.loggedOut;
            console.log(`Conexión cerrada (código ${codigo}). Reconectar: ${reconectar}`);
            if (reconectar) {
                setTimeout(conectarWhatsApp, 3000);
            } else {
                console.log('Sesión cerrada. Borra auth_info/ y reinicia para vincular de nuevo.');
            }
        }

        if (connection === 'open') {
            console.log('WhatsApp conectado y listo para enviar mensajes.');
        }
    });

    sock.ev.on('creds.update', saveCreds);
}

/**
 * Normaliza un número telefónico mexicano.
 * Espera recibir 10 dígitos limpios desde PHP, pero hace validación extra.
 * @param {string} telefono
 * @returns {string|null} Número limpio de 10 dígitos o null si es inválido
 */
function normalizarTelefono(telefono) {
    if (!telefono) return null;
    let limpio = String(telefono).replace(/\D/g, '');

    // Si viene con código de país 52 (12 dígitos)
    if (limpio.length === 12 && limpio.startsWith('52')) {
        limpio = limpio.slice(2);
    }
    // Si viene con 521 formato antiguo (13 dígitos)
    if (limpio.length === 13 && limpio.startsWith('521')) {
        limpio = limpio.slice(3);
    }

    // Debe ser exactamente 10 dígitos y empezar con 2-9
    if (limpio.length !== 10 || limpio[0] === '0' || limpio[0] === '1') {
        return null;
    }

    return limpio;
}

// Endpoint para enviar mensajes
app.post('/send', async (req, res) => {
    const { telefono, mensaje } = req.body;

    if (!telefono || !mensaje) {
        return res.status(400).json({ error: 'Se requieren telefono y mensaje' });
    }

    const telNormalizado = normalizarTelefono(telefono);
    if (!telNormalizado) {
        console.warn(`Número inválido recibido: ${telefono}`);
        return res.status(400).json({ error: `Número inválido: ${telefono}. Debe ser 10 dígitos.` });
    }

    if (!sock) {
        return res.status(503).json({ error: 'WhatsApp no conectado aún' });
    }

    try {
        const jidCandidato = `52${telNormalizado}@s.whatsapp.net`;
        const [resultado] = await sock.onWhatsApp(jidCandidato);

        if (!resultado?.exists) {
            console.warn(`Número ${telNormalizado} no encontrado en WhatsApp`);
            return res.status(404).json({ error: `El número ${telNormalizado} no está en WhatsApp` });
        }

        console.log(`Enviando a JID: ${resultado.jid}`);
        await sock.sendMessage(resultado.jid, { text: mensaje });
        res.json({ ok: true });
    } catch (err) {
        console.error('Error enviando WhatsApp:', err.message);
        res.status(500).json({ error: err.message });
    }
});

// Endpoint para enviar PDF
app.post('/send-pdf', async (req, res) => {
    const { telefono, ruta, mensaje } = req.body;

    if (!telefono || !ruta) {
        return res.status(400).json({ error: 'Se requieren telefono y ruta' });
    }

    if (!sock) {
        return res.status(503).json({ error: 'WhatsApp no conectado aún' });
    }

    if (!existsSync(ruta)) {
        return res.status(404).json({ error: `Archivo no encontrado: ${ruta}` });
    }

    const telNormalizado = normalizarTelefono(telefono);
    if (!telNormalizado) {
        console.warn(`Número inválido para PDF: ${telefono}`);
        return res.status(400).json({ error: `Número inválido: ${telefono}. Debe ser 10 dígitos.` });
    }

    try {
        const jidCandidato = `52${telNormalizado}@s.whatsapp.net`;
        const [resultado] = await sock.onWhatsApp(jidCandidato);

        if (!resultado?.exists) {
            console.warn(`Número ${telNormalizado} no encontrado en WhatsApp`);
            return res.status(404).json({ error: `El número ${telNormalizado} no está en WhatsApp` });
        }

        console.log(`Enviando PDF a JID: ${resultado.jid}`);
        await sock.sendMessage(resultado.jid, {
            document: readFileSync(ruta),
            mimetype: 'application/pdf',
            fileName: basename(ruta),
            caption: mensaje || '',
        });

        res.json({ ok: true });
    } catch (err) {
        console.error('Error enviando PDF por WhatsApp:', err.message);
        res.status(500).json({ error: err.message });
    }
});

// Solo escucha en localhost
app.listen(3001, '127.0.0.1', () => {
    console.log('Microservicio WhatsApp escuchando en http://localhost:3001');
});

conectarWhatsApp();
