<?php

if (getenv('env') === 'production') {
  $dbc = mysqli_connect('us-cdbr-iron-east-03.cleardb.net', 'bb57ea3b75eb99', '5510cfa0', 'heroku_b9761dfb1ecf620')
} else {
  $dbc = mysqli_connect('localhost', 'root', 'root', 'cherish');
}
