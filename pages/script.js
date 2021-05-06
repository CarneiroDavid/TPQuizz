function nextQuestion(x, idReponse = null)
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
    if(idReponse != null)
    {
        document.getElementById("Reponse["+ x +"]").value = idReponse;
    }
}
function precQuestion(x, idReponse = null)
{
    var questionPrec = document.getElementById("question"+(x-1));
    var questionActuelle = document.getElementById("question"+x);

    if(questionActuelle.style.display == "block")
    {
        questionActuelle.style.display = "none";
    }

    if(questionPrec.style.display == "none")
    {
        questionPrec.style.display = "block";
    }
    if(idReponse != null)
    {
        document.getElementById("Reponse["+ x +"]").value = idReponse;
    }
}