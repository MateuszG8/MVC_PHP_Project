
        <?php
        function edycja($row)
        {
            echo '<section id="przepis">
    <div class="container">
                        
                                    <form method="post"  validate>
                                                                   <div class="form-group">
                                                                   <input type="hidden" name="id" value='.$row['id'].'>
                                                                   <label for="Nazwa">Nazwa</label>
                                                                   <input class="form-control" type="text" name="nazwa" id="nazwa" value="' . $row["nazwa"] . '" required>
                                                                   </div>
                                                                   <div class="form-group">
                                                                       <label for="kategoria">Kategoria</label>
                                                                       <select class="form-control" id="kategoria" name="kategoria" value="' . $row["kategoria"] . '">
                                                                           <option value="1">Śniadania</option>
                                                                           <option value="2">Dania główne</option>
                                                                           <option value="3">Kolacje</option>
                                                                           <option value="4">Desery</option>
                                                                       </select>
                                                                   </div>
                                                                   <div class="form-group">
                                                                       <label for="trudnosc">Poziom trudności</label>
                                                                       <select class="form-control" id="trudnosc" name="trudnosc" value="' . $row["trudnosc"] . '">
                                                                           <option value="1">Łatwy</option>
                                                                           <option value="2">Średni</option>
                                                                           <option value="3">Trudny</option>
                                                                       </select>
                                                                   </div>
                                                                   <div class="form-group">
                                                                       <label for="porcje">Ilość porcji</label>
                                                                       <input class="form-control" type="text" name="porcje" id="porcje" value="' . $row["porcje"] . '"required>
                                                                   </div>
                                                                   <div class="form-group">
                                                                       <label for="opis">Opis</label>
                                                                       <textarea class="form-control" id="opis" name="opis" rows="3" required>' . $row["przepis"] . '</textarea>
                                                                   </div>
                                                                   <div class="form-group">
                                                                       <label for="skladniki">Skladniki</label>
                                                                       <textarea class="form-control" id="skladniki" name="skladniki" rows="3" required>' . $row["skladniki"] . '</textarea>
                                                                   </div>
                                                                   <div class="form-group">
                                                                       <label for="zdjecie">Link do zdjecia</label>
                                                                       <input class="form-control" type="text" name="zdjecie" id="zdjecie" value="' . $row["zdjecie"] . '" required>
                                                                   </div>
                                                                   <div class="form-group">
                                                                       </br>
                                                                       <input type="submit" name="submit" value="Edytuj przepis" class="btn btn-dark" >
                                                                       
                                                                       <input type="submit" name="submit" value="Usuń przepis" class="btn btn-dark" >
                                                                   </div>
                                                        </form>    </div>
</section>'
            ;
        }

        ?>
