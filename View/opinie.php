<?php
function show_opinions_header(){
    echo '<div class="text-center" style="border-top: 5px solid black"> 
<table class="table">
  <thead>
    <tr>
      <th scope="col">Użytkownik</th>
      <th scope="col">Ocena</th>
      <th scope="col">Opinia</th>
    </tr>
  </thead>
  <tbody>';
}
function show_opinions_footer(){
    echo '  </tbody>
            </table>
            </div>';
}
function show_opinions($row)
{
    echo '
    <tr>
      <td>' . $row['login'] . '</td>
      <td>' . $row['ocena'] . '</td>
      <td>' . $row['opinia'] . '</td>
    </tr>
';

}

function show_opinions_logged()
{
    echo '<div class="text-center" style="padding: 15px;">
<button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#OpinieModal">
                Dodaj opinie
            </button>
</div>
           ';


}

?>
<div class="modal fade" id="OpinieModal" tabindex="-1" aria-labelledby="OpinieModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dodaj opinie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../Controller/index.php" method="post" class="needs-validation">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="Opinia" class="col-form-label">Opinia</label>
                        <textarea class="form-control" id="opis" name="opis" rows="3" required></textarea>
                        <div class="invalid-feedback">
                            Wypełnij to pole
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Ocena">Ocena</label>
                        <select class="form-control" id="ocena" name="ocena">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <div class="invalid-feedback">
                            Wypełnij to pole
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-dark" name="Opinia" id="Opinia" value="Dodaj Opinie">
                </div>
            </form>
        </div>
    </div>
</div>
