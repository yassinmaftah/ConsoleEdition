<?php

require_once "ConsoleEdition.php";

class App {
    protected array $USERS = [];

    public function __construct() {
        $this->USERS = [
            new Admin("admin1@test.com", "AdminOne", "1111"),
            new Admin("admin2@test.com", "AdminTwo", "2222"),
            new Admin("admin3@test.com", "AdminThree", "3333"),

            new Editor("editor1@test.com", "EditorOne", "4444"),
            new Editor("editor2@test.com", "EditorTwo", "5555"),
            new Editor("editor3@test.com", "EditorThree", "6666"),

            new Author("author1@test.com", "AuthorOne", "7777"),
            new Author("author2@test.com", "AuthorTwo", "8888"),
            new Author("author3@test.com", "AuthorThree", "9999"),
        ];

        $art1 = new Article(
            "Intro to PHP", 
            "PHP is a server scripting language...", 
            "PHP Basics",
            "Draft", 
            7
        );
        $this->USERS[6]->addArticle($art1); 

        $art2 = new Article(
            "Laravel vs Symfony", 
            "Comparison between frameworks...", 
            "Frameworks", 
            "Publish", 
            7
        );
        $this->USERS[6]->addArticle($art2);

        $art3 = new Article(
            "Why I love Coding", 
            "Coding is life...", 
            "Lifestyle", 
            "Draft", 
            8
        );
        $this->USERS[7]->addArticle($art3);

    }

    public function AddUser($user)
    {
        $this->USERS[] = $user;
    }

    public function GetAllUsers(){
        return $this->USERS;
    }

    public function SetAllUser($AllUserNewData)
    {
        $this->USERS = $AllUserNewData;
    }

    public function login(string $email, string $password) 
    {
        foreach ($this->USERS as $user)
        {
            if($user->getemail() == $email && $user->getpassword() == $password)
            {
                return $user;
            }
        }
        return null;
    }

    public function getAllArticles() 
    {
        $all = [];
        foreach ($this->USERS as $user) {
            if ($user instanceof Author)
                $all = array_merge($all, $user->getArticles());
        }
        return $all;
    }
}



function menuAdmin($user,$app)
{

    while (true)
    {
        echo "\n-------Welcode to Admin Dashboard-------\n";
        echo "\n\n";
        echo "0. exist\n";
        echo "1. Add user\n";
        echo "2. Delete User\n";
        echo "3- Dispaly All Users\n";

        $choix = trim(fgets(STDIN));

        if ($choix == 1)
        {
            echo "\n------Add New User------";
            echo "\n\n";
            echo "Entre role of User\n";
            echo "1- Admin\n";
            echo "2- Editor\n";
            echo "3- Author\n";
            echo "4- Cancel\n";

            $choixRole = trim(fgets(STDIN));

            if ($choixRole == 1)
            {
                $NewObjUser = $user->CreateUser("Admin");
                $app->AddUser($NewObjUser);
                echo "Add user is valid\n";
            }
            elseif ($choixRole == 2)
            {
                $NewObjUser = $user->CreateUser("editor");
                $app->AddUser($NewObjUser);
                echo "Add user is valid\n";
            }
            else if ($choixRole == 3)
            {
                $NewObjUser = $user->CreateUser("Author");
                $app->AddUser($NewObjUser);
                echo "Add user is valid\n";
            }
            else if ($choixRole != 4)
            {
                echo "Invalid Chiox!\n";
            }
            else  
                break;

        }
        elseif ($choix == 2)
        {
            $AllUsersData = $app->GetAllUsers();
            $AllUsersData = $user->deleteUser($AllUsersData);
            $app->SetAllUser($AllUsersData);
            echo "User Deleted\n";
        }
        else if ($choix == 3)
        {
            $AllUsers = $app->GetAllUsers();

            foreach ($AllUsers as $u)
            {
                echo "\nUser Id : " . $u->getId();
                echo "\nUser Name : " . $u->getUsername();
                echo "\nDate Creation Account : " . $u->GetDateCreation() . "\n";
            }
        }
        elseif ($choix != 0)
        {
            echo "Incorroct Choix";
        }
        else
            break;
    }
};
function menuEditor($user, $app) 
{
    while (true)
    {
        echo "\n--- EDITOR DASHBOARD ---\n";
        echo "1. Valider les Articles (Draft -> Publish)\n";
        echo "2. display All Articls Published\n";
        echo "3. Exit\n==> ";

        $choix = trim(fgets(STDIN));

        if ($choix == 1)
        {
            $allArticles = $app->getAllArticles();
            
            $user->ArticleStatus($allArticles);
        }
        else if ($choix == 2)
        {
            $articles = $app->getAllArticles();

            foreach($articles as $article) 
            {
                if ($article->getStatus() == "Publish" )
                    echo "\nTitle: " . $article->getTitle() . " | Status: " . $article->getStatus();
            }
        }
        elseif($choix == 3)
            break;
    }
}
function menuAuthor($user,$app)
{
    while (true)
    {
        echo "\nAuthor options\n";
        echo "1. ADD ARTICLE\n";
        echo "2. My Articles\n";
        echo "3. All articles\n";
        echo "4. exit\n";

        $choix = trim(fgets(STDIN));

        if($choix == 1)
        {
        
            echo "Titre: ";
            $titre = trim(fgets(STDIN));
            echo "Contenu: ";
            $content = trim(fgets(STDIN));
            echo "excerpt: ";
            $excerpt = trim(fgets(STDIN));

            $newArticle = new Article($titre, $content, $excerpt, "Draft", $user->getId());

            $user->addArticle($newArticle);

            echo "Article Added\n";
        }
        else if ($choix == 2)
        {
            $allArticles =  $user->getArticles();

            if (empty($allArticles))
            {
                echo "You don't have any Article\n";
            }
            else
            {
                foreach($allArticles as $artile)
                {
                    echo "\n----- " . $artile->getTitle() . "-------\n";
                    echo "\nCreated BY: " . $user->getUsername();
                    echo $artile->getContent() . "\n";
                    echo "Status: " . $artile->getStatus() . "\n";
                    echo "created At " . $artile->getCreatedAt() . "\n";
                }
            }
        }
        else if ($choix == 3)
        {
            $articles = $app->getAllArticles();

            foreach($articles as $article) 
            {
                if ($article->getStatus() == "Publish" )
                    echo "\nTitle: " . $article->getTitle() . " | Status: " . $article->getStatus();
            }
        }
        else
            break ;
    }
};

//code of main 

function displaymenuLogin()
{
         $app = new App();
    while (true)
    {
   
        // $currentUser = null;
        echo "\n1- Login\n";
        echo "2- Display All Articles\n";
        echo "3- exist\n";
    
        $choix = trim(fgets(STDIN));
    
        if ($choix == 1)
        {
            echo "\n=======================\n";
            echo "\n  BLOG - Login page    \n";
            echo "\n=======================\n";
            

            echo "Entre Your Email\n";
            echo "==> ";
            $email = trim(fgets(STDIN, 100));
            echo "Entre Your Password\n";
            echo "==> ";
            $password = trim(fgets(STDIN, 100));

            $user = $app->login($email, $password);

            if ($user)
            {
                $currentUser = $user;
                // print_r($currentUser);
                if ($user instanceof Admin)
                {
                    // echo "Admin\n";
                    menuAdmin($user, $app);
                }
                else if ($user instanceof editor)
                {
                    // echo "Editor\n";
                    menuEditor($user, $app);
                }
                else
                {
                    // echo "Author";
                    menuAuthor($user,$app);
                }
            }
            else
                echo "We don't have this Account";
        }
        elseif ($choix == 2)
        {
            $articles = $app->getAllArticles();

            foreach($articles as $index => $article) 
            {
                if ($article->getStatus() == "Publish")
                {
                    echo "Article n° : $index\n";
                    echo "\nTitle: " . $article->getTitle() . " | Status: " . $article->getStatus();
                    echo "\n<Add Comment>\n";
                }
            }
        }
        else
            break;
    }

}

displaymenuLogin();