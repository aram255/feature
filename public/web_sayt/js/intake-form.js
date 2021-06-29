let addQuestionButton = document.getElementById("add-question");
addQuestionButton.addEventListener('click', addQuestion)
let i = 0;
function addQuestion() {
   let addQuestion = document.getElementById('intake-form__section-checkbox' + i);
   let questionClone = addQuestion.cloneNode(true);
   questionClone.id = "intake-form__section-checkbox" + ++i;
   addQuestion.parentNode.appendChild(questionClone);
   $("#intake-form__section-checkbox" + i).find('input,textarea,select').val('');

}