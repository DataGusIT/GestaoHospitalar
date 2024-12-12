
const listarPacientes = async () =>{

    const dados =await fetch("./historico.php");
    const resposta = await dados.json();
    console.log(resposta);

    if(!resposta['status']){
        document.getElementById("msgAlerta").innerPHP = resposta['msg'];
    } else{

        const conteudoBody = document.querySelector(".listar-Pacientes");

        if (conteudoBody) {
            conteudoBody.innerPHP = resposta['dados'];
        }
    }

}

listarPacientes();