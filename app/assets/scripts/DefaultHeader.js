var colorAnim = document.querySelector(".navbar");
var color = 120; 
var regulate = 1;

setInterval(function () 
{
 color = color + regulate  % 360;
 if(color ==500){regulate = -1;}
 if(color == 121){regulate = 1;}
 colorAnim.style.backgroundColor = "hsl(" + color + ",10%, 40%)";
}
, 10);
