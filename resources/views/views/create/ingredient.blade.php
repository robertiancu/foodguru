@extends ('layouts.main')

@section ('content')

<h1 class="page-header">Adauga un ingredient</h1>

<form class="form-horizontal" role="form" method="POST" action="/ingredient/create" enctype="multipart/form-data">
        {{ csrf_field() }}


        <div class="form-group">
            <label for="name" class="col-md-4 control-label">Nume : </label>
            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" placeholder="Numele ingredientului" required>
            </div>
        </div>


        <div class="form-group">
            <label for="public" class="col-md-4 control-label">Public : </label>
            <div class="funkyradio col-md-4">
                    <div class="funkyradio-warning">
                        <input type="checkbox" name="checkbox" id="checkbox5" checked/>
                        <label for="checkbox5">Public</label>
                    </div>
            </div>
        </div>


        <div class="form-group">
            <label for="description" class="col-md-4 control-label">Descriere : </label>
            <div class="col-md-6">
                <textarea id="description" class="form-control" name="description" rows="4" required></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="image" class="col-md-4 control-label">Poza cu ingredientul: </label>
            <div class="col-md-6">
                <input id="image" type="file" class="form-control-file" name="image">
            </div>
        </div>


        <div class="form-group">
            <label for="unit" class="col-md-4 control-label">Unitate de masura: </label>
            <div class="col-md-6">
                <input id="unit" type="text" class="form-control" name="unit" placeholder="Unitate de masura" required>
            </div>
        </div>

        <hr>

        <h3>Procentajele nutrientilor: </h3>

        <div class="form-group">
            <label for="proteins" class="col-md-4 control-label">Proteine: </label>
            <div class="col-md-6">
                <input id="proteins" type="text" class="form-control" name="proteins" placeholder="Nr. proteine" required>
            </div>
        </div>

        <br>

        <div class="form-group">
            <label for="carbs" class="col-md-4 control-label">Glucide: </label>
            <div class="col-md-6">
                <input id="carbs" type="text" class="form-control" name="carbs" placeholder="Nr. glucide" required>
            </div>
        </div>

        <br>


        <div class="form-group">
            <label for="fats" class="col-md-4 control-label">Grasimi: </label>
            <div class="col-md-6">
                <input id="fats" type="text" class="form-control" name="fats" placeholder="Nr. grasimi" required>
            </div>
        </div>

        <br>

        <div class="form-group">
            <label for="fibers" class="col-md-4 control-label">Fibre: </label>
            <div class="col-md-6">
                <input id="fibers" type="text" class="form-control" name="fibers" placeholder="Nr. fibre" required>
            </div>
        </div>

        <br>

        <div class="form-group">
            <label for="calories" class="col-md-4 control-label">Calorii: </label>
            <div class="col-md-6">
                <input id="calories" type="text" class="form-control" name="calories" placeholder="Nr. calorii" required>
            </div>
        </div>

        <hr>

        <h3>Clasa: </h3>


        <div class="col-md-6">
            <div class="form-group">
                <div class="funkyradio">
                        <div class="funkyradio-warning">
                            <input type="radio" name="class" id="radio1" />
                            <label for="radio1" value="1">Foarte uzual</label>
                        </div>

                        <div class="funkyradio-warning">
                            <input type="radio" name="class" id="radio2" checked/>
                            <label for="radio2" value="2">Uzual</label>
                        </div>

                        <div class="funkyradio-warning">
                            <input type="radio" name="class" id="radio3" />
                            <label for="radio3" value="3">Deloc uzual</label>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <br>

        <input class="btn btn-primary center-block" type="submit" value="Salveaza reteta">

        <br>

    </form>

@endsection
