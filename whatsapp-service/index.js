import makeWASocket, {
    useMultiFileAuthState,
    DisconnectReason,
    fetchLatestBaileysVersion,
} from '@whiskeysockets/baileys';
import express from 'express';
import pino from 'pino';
import qrcode from 'qrcode-terminal';

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

// Endpoint para enviar mensajes
app.post('/send', async (req, res) => {
    const { telefono, mensaje } = req.body;

    if (!telefono || !mensaje) {
        return res.status(400).json({ error: 'Se requieren telefono y mensaje' });
    }

    if (!sock) {
        return res.status(503).json({ error: 'WhatsApp no conectado aún' });
    }

    try {
        // Buscar el JID real del número (resuelve el formato correcto para México)
        const jidCandidato = `52${telefono}@s.whatsapp.net`;
        const [resultado] = await sock.onWhatsApp(jidCandidato);

        if (!resultado?.exists) {
            console.warn(`Número ${telefono} no encontrado en WhatsApp`);
            return res.status(404).json({ error: `El número ${telefono} no está en WhatsApp` });
        }

        console.log(`Enviando a JID: ${resultado.jid}`);
        await sock.sendMessage(resultado.jid, { text: mensaje });
        res.json({ ok: true });
    } catch (err) {
        console.error('Error enviando WhatsApp:', err.message);
        res.status(500).json({ error: err.message });
    }
});

// Solo escucha en localhost
app.listen(3001, '127.0.0.1', () => {
    console.log('Microservicio WhatsApp escuchando en http://localhost:3001');
});

conectarWhatsApp();
