jQuery(function($){ 
    //fake comments
    var popup = document.getElementById('popup');
    var button = document.getElementById('fake');
    var fieldVal = document.getElementById("comment");
    var nameInput = document.getElementById("login-com");
    button.addEventListener("click", function(){
        var valText = fieldVal.value;
        var valName = nameInput.value;
        if(valText == ""){
            fieldVal.classList.add('error-text');
            nameInput.classList.add('error-text');
        }else{
            fieldVal.classList.remove('error-text');
            popup.classList.add('show-thanks');
            nameInput.classList.remove('error-text');
        }
        
    });
    popup.addEventListener("click", function(){
       popup.classList.remove('show-thanks');
        fieldVal.value = "";
        nameInput.value = "";
    });
 
    
    /*** 
    *** get Date functions
    *** functions for collection Different formats of Date
    ***/
    //Declare a custom class with dates
    getVariusDate('week-ago','minus',7);//first arg is a class name, second statemento //plus/minus, third is a days number
    getVariusDate('current-date');
 
  
    /*** Sidebar polling
    *** function to switch fake questionnaire on medicreporters template- article
    ***/
    if($(jQuery('.query-container')).length != 0) {
       jQuery('.querry-button').on('click', function(e){
           jQuery('.query-wrap').hide();
           jQuery('.query-results').show();
       })
    }
    

/***Various functions
/***
/****/

    
//function to return various date
//only first argument is necessary,if we leave rest empty function return current date to the class with name of first argument
//firs argument is a string => plus/minus,
//sec is a number

function getVariusDate(name,condition,number){
    var myDate = new Date();
    if(condition == 'minus'){ myDate.setDate(myDate.getDate() - number)}
    if(condition == 'plus'){ myDate.setDate(myDate.getDate() + number) }
    var month = myDate.getMonth()+1;
    var day = myDate.getDate();
    var output = myDate.getFullYear() + '/' +
    (month<10 ? '0' : '') + month + '/' +
    (day<10 ? '0' : '') + day;
    if(jQuery('.'+name).length != 0) {
      jQuery('.'+name).html(output);
    }else{return false}                          
}
    
    

})//end ready
 

 // ankieta
jQuery('.actions .querry-button, #showResult, .actions input, #questionSubmit').on('click', function() {
    jQuery('.query-group , .query-wrap .actions, #query, #questionchoose').hide();
    jQuery('.query-results, #result, #questionResults').show();
    jQuery('.query-wrap').css('paddingBottom', 0);
    jQuery('.query-results').css('paddingTop', 0);
});
