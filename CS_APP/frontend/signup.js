const button = document.querySelector(".button")////ON Récupere <input type="submit" class="button"></div> dans html
button.addEventListener('click',envoyer)//apres on ajoute un évenement de click sur le button que on a récuperer dans 1er ligne////
//////Donc Si l'utilisateur click sur "sumbit" la fonction envoyer va etre déclencher
///la fonction "envoyer" va envoyer les donnnes du formulaire récupere de "singup.html"  dans un variable "formData"


function envoyer(){
    var status ////pour vérifier l'état du réponse qui vient du Model.php///
    var data = new FormData(document.querySelector("form")) //////Récupération de saisie d'utilisateur(formulaire)
    console.log(data)
    
    ////API FETCH : ENVOI DES REQUETE , SORTIE: PROMIS DE RENVOIER DES REPONSE////
    fetch("http://localhost/CS_APP/backend/model.php", { ///URL ou se trouve notre Model.php//Model.php se trouve dans le serveur XAMP ou MAMP....etc avec address "Localhost :8080"// mais notre Signup.js se trouve dans Live Server avec address "Localhost :5501"
            ////Comme Model.php et Signup.js sont des serveurs différents avec des addresse diffrents donc il on connecte les deux a l'aide de API (Fetch API dans notre cas)
    
        method:"POST", ////Méthode d'envoie car on a des donnes critique on utilise GET au lieu du POST
        body:data ////intégration des données dans la requete pour envoyer a "Model.php"////

    }).then(function(res){ ///1ére "then" pour récuperer la réponse qui vient du "Model.php"
        console.log(res) ////AFFICHAGE///
        status = res.status ////on récupere le status pour que on puisse utiliser apres///
        return res.text() /////on appelle res.text() pour récupere plus d'informations sur la requete  plus précisement récupere tous les echo "....." dans modele.php
     }
    )
    
    .then( function(res2){ //////2éme "then"pour récupere la réponse qui vient du res.text()
   
            alert(res2 ) /////afficher donnés qu'on a récuperé de res.text()
            if(status == 200){//////////////// 200 = réponse est correcte , 400 = réponse incorrecte ///////
                console.log("SUCESS")

            } 
            if(status == 400){
                alert("Echec")
            }
    })
    .catch(function(err){
        alert(err) ////Failed to fetch
    }
    )

}


/*y = ["kj","khkhk"]
y.index*/
/*
x = "SAIF" ////VAleur primitive
y = [] ///OBJET

objet = {
    //CLé// ///VALEUR//
    amira : "khouloud",
    ALEX : function(){
        console.log("hu")
    }

}

console.log(objet["amira"])
*/
