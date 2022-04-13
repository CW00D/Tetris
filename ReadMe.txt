The code for the tetris game can be found within the azure web server at the file location /var/www/tetris_coursework.
The controls for the game are the left, down and right arrow keys for moving in the relative directions.
By hitting the up arrow key you will rotate the current block by 90 degrees clockwise
(Note: the piece wont rotate if it would rotate to outside of the grid bounds.)
You can pause/resume the game by either clicking the pause/resume button at the bottom or by clicking the "p key".

You can access the tetris game online by accesing the following url. This leads to the home page:
http://ml-lab-4d78f073-aa49-4f0e-bce2-31e5254052c7.ukwest.cloudapp.azure.com:51857/index.php

The project structure is as follows:
	-css:
		TetrisStyle.css
	-img:
		tetris_logo.png
		tetris-grid-bg.png
	-javascript:
		tetris.js
	-music:
		music.mp3
	index.php
	leaderboard.php
	logout.php
	register.php
	tetris.php