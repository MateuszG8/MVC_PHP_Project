<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Logowanie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../Model/zaloguj.php" method="post" class="needs-validation">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="login" class="col-form-label">Login:</label>
                        <input type="text" class="form-control" id="login" name="login" required>
                        <div class="invalid-feedback">
                            Wypełnij to pole
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <div class="invalid-feedback">
                            Wypełnij to pole
                        </div>
                    </div>
                    <?php
                    if(isset($_SESSION['blad'])&&($_SESSION['blad']==true))
                    {
                        echo '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-dark" href="../register/index.php">Resjestracja</a>
                    <input type="submit" class="btn btn-dark" name="Logowanie" id="Logowanie" value="Zaloguj">
                </div>
            </form>
        </div>
    </div>
</div>