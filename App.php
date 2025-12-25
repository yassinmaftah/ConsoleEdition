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

        // array article = get articles from authors 
    }

    public function login(string $email, string $password) 
    {
        foreach ($this->USERS as $user)
        {
            // echo "email : " . $user->getemail() . ", " . "password: " . $user->getpassword() . "\n";
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



function menuAdmin()
{

};
function menuEditor() 
{
    
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
        else if ($choix = 3)
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
    $currentUser = null;
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
            menuAdmin();
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

displaymenuLogin();