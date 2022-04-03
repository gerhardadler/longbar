<?php

$page = file_get_contents('../category-template.html');

$guides_xml = simplexml_load_file("../guides.xml");
$guide_template = '
                    <div class="guide">
                        <img class="guide-img" src="[guide_img]">
                        <div class="guide-main">
                            <h2 class="blue">[guide_title]</h2>
                            <p>
                                [guide_description]
                            </p>
                            <a href="#" class="guide-button">Read more</a>
                        </div>
                    </div>
';

$guide_output = '';

$to_be_replaced = array('[guide_title]',
                        '[guide_description]',
                        '[guide_img]'
);

foreach($guides_xml->children() as $guide) {
    if (strpos($guide->categories, 'equipment') !== false ) { // If the correct category is used on the guide
        $replacement = array($guide->title, $guide->description, $guide->img);
        $guide_output .= str_replace($to_be_replaced, $replacement, $guide_template);
    };
};

$to_be_replaced = array('[title]',
                        '[description]',
                        '[guides]'
);

$replacement = array('Equipment',
                     'Descripton babbbbeeee!',
                     $guide_output
);

$page = str_replace($to_be_replaced, $replacement, $page);
echo $page;
?>