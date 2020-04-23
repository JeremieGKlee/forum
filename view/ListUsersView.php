<?php

    $users = $result['data']['users'];
    
?>
<h1>Top User</h1>

<h2>Top créateur de Topics</h2>
<ul>
<?php
    foreach($users as $user){
        echo "<li>", $user->getUsername(), ", inscrit depuis le ", $user->getRegisterdate(), "</li>";
    }
    
?>
</ul>

<h2>Top créateur de Posts</h2>
<ul>
<?php
    foreach($users as $user){
        echo "<li>", $user->getUsername(), ", inscrit depuis le ", $user->getRegisterdate(), "</li>";
    }
    
?>
</ul>