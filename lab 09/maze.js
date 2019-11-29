/* CSE3026 : Web Application Development
 * Lab 09 - Maze
 */

"use strict";
var loser = null;  // whether the user has hit a wall
var endalert = false;



window.onload = function() {
    var walls = $$('.boundary');
    for (var i=0; i<walls.length; i++){
        walls[i].addEventListener("mouseover", overBoundary);
    }

    $('end').addEventListener("mouseover", overEnd);
    $('start').addEventListener("click", startClick);
    document.querySelector("body").addEventListener("mouseover", overBody);
};



// called when mouse enters the walls; 
// signals the end of the game with a loss
function overBoundary(event) {
    var walls = $$('.boundary');
    if (endalert === true) {
        for (var i=0; i<walls.length; i++){
            walls[i].addClassName('youlose');
        }
    }
}

// called when mouse is clicked on Start div;
// sets the maze back to its initial playable state
function startClick() {
    endalert = true;
    $('status').innerText = "Find the end";
    var walls = $$('.boundary');
    for (var i=0; i<walls.length; i++){
        walls[i].removeClassName('youlose');
    }
    $('end').addEventListener("mouseover", overEnd);
}

// called when mouse is on top of the End div.
// signals the end of the game with a win
function overEnd() {
    var walls = $$('.boundary');
    for (var i=0; i<walls.length; i++) {
        if (walls[i].hasClassName('youlose') === false && endalert === true) {
            $('end').removeEventListener("mouseover", overEnd);
            endalert = false;
            $('status').innerText = "You win! :)";
        } else if (walls[i].hasClassName('youlose') === true && endalert === true) {
            $('end').removeEventListener("mouseover", overEnd);
            endalert = false;
            $('status').innerText = "You Lose! :<";
        }
    }
}

// test for mouse being over document.body so that the player
// can't cheat by going outside the maze
function overBody(event) {
    if (document.body == event.element() && endalert === true) {
        overBoundary();
        overEnd();
    }
}



