<?php
include __DIR__ . "/partials/header.part.php";
?>

<div id="notfoundcont">
    <h1>404 - Not found</h1>
</div>

<style>
#notfoundcont {
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height: 100vh;
    height: calc(100 * var(--vh));
    background-color: var(--black);
    color: var(--white);
    display: flex;
    flex-direction: column;
    justify-content: space-around;
}

#notfoundcont h1 {
    text-align: center;
    margin: 0
}

</style>

<?php
include __DIR__ . "/partials/footer.part.php";
?>