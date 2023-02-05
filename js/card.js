let cardWrapper = document.querySelector('.card-wrapper');
let parent;
let prevParent;
cardWrapper.addEventListener('mouseover', cardOver);

function cardOver(event) {
    parent = event.target.closest('.card-outer');
    prevParent = parent.previousElementSibling;
    parent.classList.add('active');
    
    if(prevParent !== null) prevParent.classList.add('nextActive');

    
    this.removeEventListener('mouseover', cardOver);
    parent.addEventListener('mouseleave', cardOut);
}

function cardOut(event) {
    if(prevParent !== null) prevParent.classList.remove('nextActive');
    
    this.classList.remove('active');
    
    this.removeEventListener('mouseleave', cardOut);
    cardWrapper.addEventListener('mouseover', cardOver);
}