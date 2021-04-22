function nextQuestion(x, idReponse)
{
    var questionSuivante = document.getElementById("question"+(x+1));
    var questionActuelle = document.getElementById("question"+x);

    if(questionActuelle.style.display == "block")
    {
        questionActuelle.style.display = "none";
    }

    if(questionSuivante.style.display == "none")
    {
        questionSuivante.style.display = "block";
    }
    document.getElementById("Reponse["+ x +"]").value = idReponse;

}