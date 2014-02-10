<?php
	// Prerequisites
	include_once($_SERVER["DOCUMENT_ROOT"] . '/examples/inc/application_top.php');
	
	// Create the post instance
	$myPost = new Post;
	
	// Only show the published posts
	$myPost->SetValue('status', 'Published');
	$myPost->SetValue('category_id', '3');
	
	// Setup the fields to pull from the post table
	$display[] = array('title', 'date_entered', 'author_id', 'body');
	
	// Create the author instance
	$myAuthor = new Author;
	
	// Join the author and post tables on the author_id
	$myPost->Join($myAuthor,'author_id','LEFT');
	
	// Setup the fields to pull from the author table
	$display[] = array('first_name','last_name','email');
	
	// Create the category instance
	$myCategory = new Category;
	
	// Join the category and post tables on the category_id
	$myPost->Join($myCategory,'category_id', 'LEFT');
	
	// Setup the fields to pull from the category table
	$display[] = array('category_id', 'category');
	
	
		
	// Get the List
	$myPost->GetList($display, 'date_entered', 'DESC', 0 , 10);
		
	// Header
	define('PAGE_TITLE','Welcome');
	include_once('inc/header.php');
?>
<div class="container" style="margin-top: 100px;">
	<div class="hero-unit">
		<h1>Blog de ejemplo</h1>
		<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. 
		Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>
		<a href="manager" class="btn btn-primary btn-large">Ir al manager</a>
	</div>

	<div id="data">
		<?php
			// If there is results returned
			if (count($myPost->results) > 0){
				echo '<dl id="posts">' . "\n";
				
				// Loop through each result
				foreach($myPost->results as $post){
				
				?>
				<div class="row">
					<h2><?= $post['title'] ?></h2>
					<p><?= truncate($post['body'], 320) ?></p>
					<div class="details">
					<p>Posted on <?= date("F j, Y \\a\\t g:i a", strtotime($post['date_entered'])) ?> by <?= htmlspecialchars($post['first_name']) . ' ' . htmlspecialchars($post['last_name']) ?></p>
					<p>Categor&iacute;a: <?= $post['category'] ?></p>					
					</div>
					<p><a class="btn" href="view.php?id=<?= $post['post_id'] ?>">Ver detalles </a></p>
					
				</div>
				<?php
				}
			
			}else{
				echo '<p>Currently there are no posts, please <a href="manager/post.php">add some</a></p>' . "\n";
			}
		?>
	</div>
</div>

<?php

function truncate($text, $length = 100, $ending = '...', $exact = true, $considerHtml = false) {
    if (is_array($ending)) {
        extract($ending);
    }
    if ($considerHtml) {
        if (mb_strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
            return $text;
        }
        $totalLength = mb_strlen($ending);
        $openTags = array();
        $truncate = '';
        preg_match_all('/(<\/?([\w+]+)[^>]*>)?([^<>]*)/', $text, $tags, PREG_SET_ORDER);
        foreach ($tags as $tag) {
            if (!preg_match('/img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param/s', $tag[2])) {
                if (preg_match('/<[\w]+[^>]*>/s', $tag[0])) {
                    array_unshift($openTags, $tag[2]);
                } else if (preg_match('/<\/([\w]+)[^>]*>/s', $tag[0], $closeTag)) {
                    $pos = array_search($closeTag[1], $openTags);
                    if ($pos !== false) {
                        array_splice($openTags, $pos, 1);
                    }
                }
            }
            $truncate .= $tag[1];

            $contentLength = mb_strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $tag[3]));
            if ($contentLength + $totalLength > $length) {
                $left = $length - $totalLength;
                $entitiesLength = 0;
                if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $tag[3], $entities, PREG_OFFSET_CAPTURE)) {
                    foreach ($entities[0] as $entity) {
                        if ($entity[1] + 1 - $entitiesLength <= $left) {
                            $left--;
                            $entitiesLength += mb_strlen($entity[0]);
                        } else {
                            break;
                        }
                    }
                }

                $truncate .= mb_substr($tag[3], 0 , $left + $entitiesLength);
                break;
            } else {
                $truncate .= $tag[3];
                $totalLength += $contentLength;
            }
            if ($totalLength >= $length) {
                break;
            }
        }

    } else {
        if (mb_strlen($text) <= $length) {
            return $text;
        } else {
            $truncate = mb_substr($text, 0, $length - strlen($ending));
        }
    }
    if (!$exact) {
        $spacepos = mb_strrpos($truncate, ' ');
        if (isset($spacepos)) {
            if ($considerHtml) {
                $bits = mb_substr($truncate, $spacepos);
                preg_match_all('/<\/([a-z]+)>/', $bits, $droppedTags, PREG_SET_ORDER);
                if (!empty($droppedTags)) {
                    foreach ($droppedTags as $closingTag) {
                        if (!in_array($closingTag[1], $openTags)) {
                            array_unshift($openTags, $closingTag[1]);
                        }
                    }
                }
            }
            $truncate = mb_substr($truncate, 0, $spacepos);
        }
    }

    $truncate .= $ending;

    if ($considerHtml) {
        foreach ($openTags as $tag) {
            $truncate .= '</'.$tag.'>';
        }
    }

    return $truncate;
}
?>