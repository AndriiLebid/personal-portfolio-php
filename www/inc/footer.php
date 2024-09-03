<footer>
    <div class="footer_menu">
        <a href="../Legal_notices.php">
            <span class="legal_notices">Legal notices</span>
        </a>
    </div>

    <?php
    if (!isset($_SESSION['username'])) {
        echo '<div class="footer_menu"><a href="../login.php"><span class="legal_notices">Login</span></a></div>';
    } else {
        echo '<div class="footer_menu"><a href="../gallery.php"><span class="legal_notices">Gallery</span></a></div>';

        if ($_SERVER['REQUEST_URI']=="/blog.php") {
            echo '<div class="footer_menu"><a href="../insertPost.php"><span class="legal_notices">Insert Post</span></a></div>';
            echo '<div class="footer_menu"><a href="../updatePost.php"><span class="legal_notices">Update Post</span></a></div>';
            echo '<div class="footer_menu"><a href="../deletePost.php"><span class="legal_notices">Delete Post</span></a></div>';
        }

        if ($_SERVER['REQUEST_URI']=="/projects.php") {
            echo '<div class="footer_menu"><a href="../insertProject.php"><span class="legal_notices">Insert Project</span></a></div>';
            echo '<div class="footer_menu"><a href="../updateProject.php"><span class="legal_notices">Project Manager</span></a></div>';
            echo '<div class="footer_menu"><a href="../deleteProject.php"><span class="legal_notices">Delete Project</span></a></div>';
        }


        echo '<div class="footer_menu"><a href="../logout.php"><span class="legal_notices">Logout</span></a></div>';
    }
    ?>
</footer>
<!-- <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script> -->
</body>

</html>