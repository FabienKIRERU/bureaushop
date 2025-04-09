<style>
    .PhotoLogo{
        margin-top: 10px;
        margin-bottom: 10px;
        width: 90%;
        height: 20%;
        /* background-color: rgb(0, 110, 255); */
        text-align: center;
    }
    .cadreLogo{
        width: 100px;
        height: 100px;
        align-items: center;
    }
    .cadreProfile{
        width: 100px;
        height: 100px;
    }
    
    .cadreProfile{
        display: none;
    }
    .transPhotoLogo .openLogo.active,
    .transPhotoLogo .openProfile.active{
        display: none;
        cursor: pointer;
    }
    .transPhotoLogo .openLogo.active,
    .transPhotoLogo .openProfile.active{
        display: block;
        width: 100px;
        height: 100px;
        background: rgb(43, 255, 0);
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .menu{
        text-align: initial;
    }
    a{
        text-decoration: none;
        color: black;
    }
    .lien{
        padding: 10px;
    }
    .lien:hover{
        background-color: blue;
        color: white;
    }
</style>

<div class="container PhotoLogo">
    <div class="cadreLogo active">
        <x-application-logo class=" h-9 w-auto fill-current text-gray-800" />
        logo de l'appi
    </div>
    <div class="cadreProfile">
        <x-application-logo class=" h-9 w-auto fill-current text-green-800" />
        photo de profile
    </div>
</div>
<hr>
<div style="text-align: justify">
    <a href="{{ route('admin.property.index') }}" class="">
        <div class="lien">
            Proprietaires
        </div>
    </a>
    <a href="" class="">
        <div class="lien">
            Fourniture Bureau
        </div>
    </a>
    <a href="" class="">
        <div class="lien">
            Commande
        </div>
    </a><hr>
    <a href="" class="">
        <div class="lien">
            Parametre
        </div>
    </a>
    <a href="" class="">
        <div class="lien">
            Corbeil
        </div>
    </a><hr> 

    <!-- Deconnexion -->
    <form method="POST" action="{{ route('logout') }}" style="text-align: center">
        @csrf
        <div>
            <button class="btn btn-light text-danger w-100">Se Deconneter</button>
        </div>
    </form>
</div>