const formulario = document.getElementById("formulario");
const contrasena = document.getElementById("contrasena");
const contrasena2 = document.getElementById("verificarContrasena");
const verificar = document.getElementById("verificar");

const campos = {
  hash: false,
  contrasena: false,
  contrasena2: false
};

const validarCampo = (expresion, input, campo) => {
  if (expresion.test(input.value)) {
    campos[campo] = true;
  } else {
    campos[campo] = false;
    verificar.disabled = true;
  }
};

const validarFormulario = (e) => {
  switch (e.target.name) {
    case "hash":
      validarCampo(expresiones.correo, e.target, "hash");
      break;
  }
};

const contrasenaLlena = () => {
  if (contrasena.value.length >= 8) {
    campos.contrasena = true;
  } else {
    campos.contrasena = false;
    verificar.disabled = true;
  }
};

const inputs = [contrasena, contrasena2];

inputs.forEach((input) => {
  input.addEventListener("keyup", validarFormulario);
});

formulario.addEventListener("keyup", (e) => {
  e.preventDefault();
  if (campos.hash) {
    verificar.disabled = false;
  }
});

const expresiones = {
  correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
};

const contrasenaInput = document.getElementById('contrasena');
const verificarContrasenaInput = document.getElementById('verificarContrasena');
const verificarButton = document.getElementById('verificar');

const checkPasswordMatch = () => {
  const contrasenaValue = contrasenaInput.value;
  const verificarContrasenaValue = verificarContrasenaInput.value;

  if (contrasenaValue === verificarContrasenaValue) {
    verificarButton.disabled = false;
  } else {
    verificarButton.disabled = true;
  }
};

contrasenaInput.addEventListener('input', checkPasswordMatch);
verificarContrasenaInput.addEventListener('input', checkPasswordMatch);

const verificarRequisitos = () => {
  const contrasenaValue = contrasenaInput.value;

  const reqCaracteres = document.getElementById('reqCaracteres');
  const reqEspecial = document.getElementById('reqEspecial');
  const reqNumero = document.getElementById('reqNumero');
  const reqMayuscula = document.getElementById('reqMayuscula');

  reqCaracteres.classList.toggle('requisito-cumplido', contrasenaValue.length >= 8);
  reqEspecial.classList.toggle('requisito-cumplido', /[!@#$%^&*()_+\-]/.test(contrasenaValue));
  reqNumero.classList.toggle('requisito-cumplido', /\d/.test(contrasenaValue));
  reqMayuscula.classList.toggle('requisito-cumplido', /[A-Z]/.test(contrasenaValue));
};

contrasenaInput.addEventListener('input', verificarRequisitos);


