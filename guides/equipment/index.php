<?php

$page = file_get_contents('../categories/category-template.html');

$articles_xml = simplexml_load_file("../categories/articles.xml");
$article_template = '
                    <div class="guide">
                        <img class="guide-img" src="[article_img]">
                        <div class="guide-main">
                            <h2 class="blue">[article_title]</h2>
                            <p>
                                [article_description]
                            </p>
                            <a href="#" class="guide-button">Read more</a>
                        </div>
                    </div>
';

$article_output = '';

$to_be_replaced = array('[article_title]',
                        '[article_description]',
                        '[article_img]'
);

foreach($articles_xml->children() as $article) {
    if (strpos($article->categories, 'equipment') !== false ) { // If the correct category is used on the article
        $replacement = array($article->title, $article->description, $article->img);
        $article_output .= str_replace($to_be_replaced, $replacement, $article_template);
    };
};

$to_be_replaced = array('[title]',
                        '[description]',
                        '[articles]'
);

$replacement = array('Equipment',
                     'Descripton babbbbeeee!',
                     $article_output
);

$page = str_replace($to_be_replaced, $replacement, $page);
echo $page;
?>