
<div >
    <a href="/homepage" >retourner à l'acceuil</a>
        
    <div>
        <form action="/ajouter_post" method="POST" enctype='multipart/form-data'>

        <div class="form">
            
            <input type="text"  id="title" name="title"  required>
        </div>

        <div class="form">
            <textarea id="content"  name="content" required></textarea>
        </div>

        <div class="form">
            <input type="file" name='file' >
        </div>
        
        <button type="submit" >Publier</button>

        </form>
    </div>
</div>