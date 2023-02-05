let mainImgParent = document.querySelector('.main-img');
let mainImg;
let arrows;

let imgsBlock = document.querySelector('.others-imgs');
let imgParent;
let img;


mainImgParent.addEventListener('mouseenter', showArrows);
imgsBlock.addEventListener('mouseover', hoverImg);

function showArrows() {
    arrows = this.querySelectorAll('.arrow');
    this.removeEventListener('mouseenter', showArrows);
    for(let elem of arrows) {
        elem.classList.remove('hidden');
        elem.addEventListener('mouseenter', changeColor1);
    }
    this.addEventListener('mouseleave', hideArrows);
}

function hideArrows(event) {
    this.removeEventListener('mouseleave', hideArrows);
    for(let elem of arrows) {
        elem.classList.add('hidden');
        elem.removeEventListener('mouseenter', changeColor1);
    }
    this.addEventListener('mouseenter', showArrows);
}

function changeColor1() {
    this.classList.add('white');
    this.removeEventListener('mouseenter', changeColor1);
    this.addEventListener('click', clickArrow);
    this.addEventListener('mouseleave', changeColor2);
}

function changeColor2() {
    this.classList.remove('white');
    this.removeEventListener('mouseleave', changeColor2);
    this.addEventListener('mouseenter', changeColor1);
}

function hoverImg(event) {
    if(event.target.className !== 'others-imgs') this.removeEventListener('mouseover', hoverImg);
    imgParent = event.target;
    if(imgParent.className === 'image-wrapper') {
        imgParent.classList.add('backlight');
        this.addEventListener('mouseout', leaveImg);
    } else if(imgParent.tagName === 'IMG') {
        imgParent = imgParent.closest('.image-wrapper');
        imgParent.classList.add('backlight');
        this.addEventListener('mouseout', leaveImg);
    }
    imgParent.addEventListener('click', clickImg);
}

function leaveImg(event) {
    imgParent.classList.remove('backlight');
    this.removeEventListener('mouseout', leaveImg);
    this.addEventListener('mouseover', hoverImg);
}

function clickImg(event) {
    img = imgParent.getElementsByTagName('IMG');
    mainImg = mainImgParent.getElementsByTagName('IMG');
    mainImg[0].src = img[0].src;
}

function clickArrow() {
    mainImg = mainImgParent.getElementsByTagName('IMG');
    img = imgsBlock.getElementsByTagName('IMG');
    let index;
    for(let i = 0; i < img.length; i++) {
            if(mainImg[0].src === img[i].src) {
                index = i;
                break;
            }
    }
    
    if(this.className === 'arrow right white') {
        if(index !== img.length - 1){
            mainImg[0].src = img[index + 1].src;
        } else {
            mainImg[0].src = img[0].src;
        }
        
    } else {
        if(index !== 0) {
            mainImg[0].src = img[index - 1].src;
        } else mainImg[0].src = img[img.length - 1].src; 
    }
}







