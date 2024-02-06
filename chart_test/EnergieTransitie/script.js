function switchBackground() {
    var element = document.body;
    var style = window.getComputedStyle(element).getPropertyValue('background-color');
    if (style === 'rgb(41, 41, 41)') {
        element.style.backgroundColor = '#ffffff';
    } else {
        element.style.backgroundColor = '#292929';
    }

    var navbara = document.querySelectorAll('.navbar a');
    for (var i = 0; i < navbara.length; i++) {
        var style = window.getComputedStyle(navbara[i]).getPropertyValue('color');
        if (style === 'rgb(255, 255, 255)') {
            navbara[i].style.color = '#000000';
        } else {
            navbara[i].style.color = '#ffffff';
        }
    }

    var navbar = document.querySelectorAll('.navbar');
    var style = window.getComputedStyle(navbar[0]).getPropertyValue('background-color');
    if (style === 'rgb(51, 51, 51)') {
        navbar[0].style.backgroundColor = '#c8c8c8';
    } else {
        navbar[0].style.backgroundColor = '#333333';
    }

    var label = document.querySelectorAll('label');
    for (var i = 0; i < label.length; i++) {
        var style = window.getComputedStyle(label[i]).getPropertyValue('color');
        if (style === 'rgb(255, 255, 255)') {
            label[i].style.color = '#000000';
        } else {
            label[i].style.color = '#ffffff';
        }
    }

    var dropbtn = document.querySelectorAll('.dropbtn');
    for (var i = 0; i < dropbtn.length; i++) {
        var style = window.getComputedStyle(dropbtn[i]).getPropertyValue('color');
        if (style === 'rgb(255, 255, 255)') {
            dropbtn[i].style.color = '#000000';
        } else {
            dropbtn[i].style.color = '#ffffff';
        }
    }
}

// check if the theme is saved in local storage and apply it on page load
document.addEventListener('DOMContentLoaded', function () {
    var theme = localStorage.getItem('theme');
    if (theme === 'light') {
        switchBackground();
    }
});


