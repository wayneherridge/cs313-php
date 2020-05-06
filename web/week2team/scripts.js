// first button shows the message 'Clicked!' when clicked.
function clickME() {
  alert("Clicked!");
}

// Vanilla Javascript
// function colorChange() {
// 	var input_id = "colorInput";
// 	var input = document.getElementById(input_id);
//
// 	var div1_id = "div1";
// 	var div1 = document.getElementById(div1_id);
//
// 	var color = input.value;
// 	div1.style.backgroundColor = color;
// }

// JQuery
// function colorChange() {
//   let colorValue = $("#colorInput").val();
//   $("#div1").css("background-color", colorValue);
// }

$(document).ready(function() {
  $("#colorChange").click(function() {
    let colorValue = $("#colorInput").val();
    $("#div1").css("background-color", colorValue);
  });
  $("#fadeOut").click(function(){
    $("#card-fade").fadeToggle(700);
  });
});
