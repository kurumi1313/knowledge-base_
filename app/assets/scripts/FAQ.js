// Functions list

document.addEventListener("load", function(){
	let list = document.createElement("ul");
	list.className = "list_block";
	
	document.querySelector(".container_lists").innerHTML = list
})

document.addEventListener("click", function(e){
	let target = e.target;
	if(target.className === "list_header" || e.target.parentElement.className === "list_header"){
		const targets = document.querySelectorAll(`.list_content_inside`),
		targets_header = document.querySelectorAll(`.list_header`),
		targets_content = document.querySelectorAll('.list_content');

		if (e.target.parentElement.className === "list_header") target = e.target.parentElement;

		for(let i = 0; i < targets.length; i++){
			targets[i].classList.remove('active');
			targets_header[i].classList.remove('active');
			targets_content[i].style.height = "0px";
		}
		target.nextElementSibling.style.height = target.nextElementSibling.firstElementChild.offsetHeight + 'px';
		target.nextElementSibling.firstElementChild.classList.add('active');
		target.classList.add('active');
	}else if(target.className === "list_header active" || e.target.parentElement.className === "list_header active"){
		if (e.target.parentElement.className === "list_header active") target = e.target.parentElement;

		target.nextElementSibling.firstElementChild.classList.remove('active');
		target.classList.remove('active');
		target.nextElementSibling.style.height = "0px";
	}else{}
});

window.addEventListener("resize", function(){
	try{
		let resize_target = document.querySelector(`.list_content_inside.active`);
		resize_target.closest(".list_content").style.height = resize_target.offsetHeight + 'px';
	}catch{}
});

// Functions popaps