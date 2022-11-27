<div >
    <div >
        <h2>Bonjour <?php echo $_SESSION['username']; ?></h2>
        <form method="POST">
            <button  type="submit" name="deco">deco</button>
        </form>
    </div>
    <?php
    foreach ($Post as $post) {
        $userPost = $userManager->getUsernameById($post->getUserId());
    ?>
        <div >

            <div >
            
                <h2><?php echo $post->getTitle(); ?></h2>
           
                 <?php if($_SESSION['id']===$post->getUserId() || $_SESSION['role']==="admin"){?>
                    <form action="homepage" method="POST" >
                        <input type="hidden" name="postId" value="<?php echo $post->getId()?>">
                        <button type="submit" name="del">delete</button>
                    </form>
                <?php } ?>
            </div>

    
            <?php
            if ($post->getImage() != "/uploads/") { ?>
                <div><img src='<?php echo $post->getImage(); ?>' alt=""></div>
            <?php
            }
            ?>

     
            <p ><?php echo $post->getContent(); ?></p>

         
            <p >
                by 
            <span>
                <?php echo $userPost["username"]; ?>
            </span> 
                on 
            <?php echo $post->getDatetime(); ?>
            </p>


     
            <form action="/ajouter_com" method="POST" >

                <input type="text" name="comment" placeholder="Comment">

                <input type="hidden" name="postId" value="<?php echo $post->getId(); ?>">
                <input type="hidden" name="comId" value="<?php echo "null" ?>">
                <button  type="submit" name="colpie">compie</button>
            </form>

      
               
                <?php foreach($Comment as $comment){
                if($comment->getPostId() === $post->getId() && $comment->getComId() === null){   
                    $userCom = $userManager->getUsernameById($comment->getUserId());
                ?>  
                    <div>
                      
                        <div >
        
                            <div >
                               
                                <p ><?php echo $userCom['username'];?></p>
                               
                                <span><?php echo $comment->getDateTime();?></span>
                            </div>
        
                         
                            <p><?php echo $comment->getContent();?></p>
                        
                            
                            
                            <form action="/ajouter-commentaire" method="POST" class="grid grid-cols-10 gap-x-2">
                                <input type="text" name="comment" placeholder="Comment" class="col-span-8 border-2 border-slate-200 rounded-full bg-slate-100 px-5 text-sm placeholder:text-slate-300 focus:text-gray-700 focus:bg-slate-100 focus:border-slate-300 focus:outline-none">
                                <input type="hidden" name="postId" value="<?php echo $post->getId(); ?>">
                                <input type="hidden" name="comId" value="<?php echo $comment->getId() ?>">
                                <button type="submit" class="col-span-2 text-indigo-400 font-semibold py-1 text-sm">Répondre</button>
                            </form> 
                            
                        </div>
        
                        
                    </div>
                  
                        <?php foreach($Comment as $respond){
                        if($comment->getId()=== $respond->getComId()){
                            $userRespond = $userManager->getUsernameById($respond->getUserId())
                        ?>
                        <div>
                     
                                    <div >
                                      
                                        <p >
                                            <?php echo $userRespond['username'];?>
                                        </p>
                                       
                                        <span>
                                            <?php echo $respond->getDateTime();?>
                                        </span>
                                    </div>   
                                   
                                    <p >
                                        <?php echo $respond->getContent();?>
                                    </p>
                                </div>
        
                       
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </div>
        
    <?php
    }
    ?>
    <a href="/ajouter_post" >+

    </a>
    <a href="/edit" >
        modifier
    </a>

    <?php if($_SESSION['role']==="admin"){?>
    <a href="/afficher_users" >
        Voir les utilisateurs</a>
    <?php } ?>

</div>