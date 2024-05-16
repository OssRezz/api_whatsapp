const token = document.querySelector("#token");
const version = document.querySelector("#version");
const plantilla = document.querySelector("#plantilla");
const id_number = document.querySelector("#id_number");
const number = document.querySelector("#number");
const identificador = document.querySelector("#identificador");

function Message(token, version, plantilla, id_number, number, identificador) {
  $.ajax({
    url: "whatsapp.php",
    type: "POST",
    data: {
      token: token,
      version: version,
      plantilla: plantilla,
      id_number: id_number,
      number: number,
      identificador: identificador
    },
    success: function (result) {
      const res = JSON.parse(result);
      console.log(res[0]);
      if(res[0].error){
        
        return Swal.fire({
            icon: "error",
            title: "Oops...",
            text: res[0].error.error_data.details,
          });
      }

      return Swal.fire({
        icon: "success",
        title: "Envio exitoso",
        text: "Mensaje enviado exitosamente al numero: " + number,
      });
    },
    error: function (error) {
      console.log(error);
    },
  });
}

const sendMessage = () => {
  console.log(token.value);
  console.log(version.value);
  console.log(plantilla.value);
  console.log(id_number.value);
  console.log(number.value);
  Message(
    token.value,
    version.value,
    plantilla.value,
    id_number.value,
    number.value,
    identificador.value
  );
};
