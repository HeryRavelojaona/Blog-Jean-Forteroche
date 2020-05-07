
<form class="post-comment form-group" action="../public/index.php?route=addcomment&articleId=<?= htmlspecialchars($article->getId());?>" method="post">
    <label for="content" class="title-form">Message</label>
    <textarea name="content" class="comment-content form-control " ></textarea>
    <span class="form-error"><?= isset($errors['content']) ? $errors['content'] : ''; ?></span>
    <input type="submit" class="btn btn-warning" id="submit" name="submit" value="Envoyer">
</form>
