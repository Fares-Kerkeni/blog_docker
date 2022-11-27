
<?php
if($_SESSION['role']==="admin"){

    foreach ($User as $user) { ?>
    
        <form action="affiche" method="POST">
       
            <p> 
                Nom d'utilisateur 
            </p>

                <?php echo $user->getUsername(); ?>

            <p>
                role

            </p>
            <?php echo $user->getEmail(); ?>


            <p>
                role
            </p>
            <?php echo $user->getRole(); ?>

            <input type="hidden" name="userId">

            <button type="submit" name="sup^user" >
                delete
            </button>

            
            
            <input  type="text" name="role" >

            <button type="submit" name="chang">
                Changement
            </button>
            </form>
        </form>
    
    <div></div>
<?php
    }
    } else {
    ?><h1>vous n'etes pas admin</h1><?php
    }
?>
<a href="/homepage">home</a>