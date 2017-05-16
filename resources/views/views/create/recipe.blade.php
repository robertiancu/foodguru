@extends('layouts.main')

@section('content')
                    <style>
                    textarea
                    {
                        margin-bottom: 15px;
                    }
                    .saverecipe
                    {
                        margin-left: 50px;
                        margin-bottom: 30px;
                    }
                    input[type=checkbox]
                    {
                        margin-left: 50px;
                    }
                    </style>
                     <script>
                            // Nu stiu cum functioneaza laravel cu js asa ca o sa las scriptul aici
                            window.onload=function()
                            {
                            plusButton=document.getElementsByClassName("plus")[0];
                             minusButton=document.getElementsByClassName("minus")[0];
                             plusButtonDiv=document.getElementById("btndiv");
                             SplusButton=document.getElementsByClassName("plus2")[0];
                             SplusButtonDiv=document.getElementById("btndiv2");

                             document.getElementById("difficulty").addEventListener("mousemove", function () {
                                document.getElementById('slider-span').innerHTML = this.value;
                            });
                         }

                            var plusButton;
                            var plusButtonDiv;
                            var minusButton;

                            function changeVal(value)
                            {
                                document.getElementById("slider-span").innerHTML=value;
                            }

                            function fetchToNum(ingredient,num)
                            {
                                goodIngredient = ingredient.cloneNode(true);
                            

                                num++;

                                label = goodIngredient.getElementsByClassName("control-label")[0];
                                label.setAttribute("for","ingredient"+num);
                                label.innerHTML="Ingredient "+num+" :";


                                names = goodIngredient.getElementsByClassName("ingredient-name")[0];
                                names.id="ingredient-name-"+num;
                                names.name="name-"+num;
                                names.value="";


                                quantity = goodIngredient.getElementsByClassName("ingredient-quantity")[0];
                                quantity.id="ingredient-quantity-"+num;
                                quantity.name="quantity-"+num;
                                quantity.value="";


                                description = goodIngredient.getElementsByClassName("ingredient-description")[0];
                                description.id="ingredient-description-"+num;
                                description.name="description-"+num;
                                description.value="";


                                delet = goodIngredient.getElementsByClassName("minus")[0];
                                delet.onclick=function(){removeIngredientForm(num-1);};


                                return goodIngredient;

                            }
                            function addNewIngredientForm()
                            {
                                ingredientsDiv = document.getElementById("ingredients-form-div");
                                ingredientForms = ingredientsDiv.getElementsByClassName("ingredient");

                                count = ingredientForms.length;
                                newForm = ingredientForms[count-1].cloneNode(true);
                                newForm = fetchToNum(newForm,count);

                                ingredientsDiv.insertBefore(newForm,plusButtonDiv);

                            }

                            function removeIngredientForm(num)
                            {
                                if(num==0)
                                    return;
                                 ingredientsDiv = document.getElementById("ingredients-form-div");
                                ingredientForms = ingredientsDiv.getElementsByClassName("ingredient");


                                for(i=num;i<ingredientForms.length;i++)
                                {
                                    formOriginal = ingredientForms[i].cloneNode(true);

                                    namesz = String(formOriginal.getElementsByClassName("ingredient-name")[0].value);
                                    quantityz = String(formOriginal.getElementsByClassName("ingredient-quantity")[0].value);
                                    descriptionz = String(formOriginal.getElementsByClassName("ingredient-description")[0].value);

                                    formz = fetchToNum(formOriginal,i-1);

                                    formz.getElementsByClassName("ingredient-name")[0].value=namesz;
                                    formz.getElementsByClassName("ingredient-quantity")[0].value=quantityz;
                                    formz.getElementsByClassName("ingredient-description")[0].value=descriptionz;

                                    ingredientsDiv.replaceChild(formz,ingredientForms[i]);
                                }

                                ingredientsDiv.removeChild(ingredientForms[num]);

                     

                            }

                                       function addNewStepForm()
                            {   
                                stepsDiv = document.getElementById("steps-form-div");
                                stepForms = stepsDiv.getElementsByClassName("step");
                                count = stepForms.length;
                                newForm = stepForms[count-1].cloneNode(true);

                                newForm = stepFetchToNum(newForm,count);
                                stepsDiv.insertBefore(newForm,SplusButtonDiv);

                            }

                            function stepFetchToNum(step,num)
                            {
                                goodStep = step.cloneNode(true);
                                num++;
                                goodStep.getElementsByTagName("label")[0].for="step"+num;
                                goodStep.getElementsByTagName("label")[0].innerHTML="Pasul "+num+" :";
                                goodStep.getElementsByClassName("step-input")[0].name="step-"+num;
                                goodStep.getElementsByClassName("step-input")[0].id="step-"+num;
                                goodStep.getElementsByClassName("step-input")[0].value="";

                                goodStep.getElementsByClassName("minus-step")[0].onclick=
                                function(){
                                    removeStepAt(num-1);
                                }
                                return goodStep;
                            }

                            function removeStepAt(num)
                            {
                                if(num==0)
                                    return;

                                stepsDiv = document.getElementById("steps-form-div");
                                stepForms = stepsDiv.getElementsByClassName("step");


                                for(i=num;i<stepForms.length;i++)
                                {
                                    formOriginal = stepForms[i].cloneNode(true);
                                    valuez = String(formOriginal.getElementsByClassName("step-input")[0].value);
                                

                                    formz = stepFetchToNum(formOriginal,i-1);
                                    formz.getElementsByClassName("step-input")[0].value=valuez;
                                    stepsDiv.replaceChild(formz,stepForms[i]);
                                }

                                stepsDiv.removeChild(stepForms[num]);

                            }
                        </script>

                    <h1 class="page-header">Recipe creator</h1>

                    <form class="form-horizontal" role="form" method="POST" action="/recipe/create" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nume :     </label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" placeholder="Chocolate Ice Cream Cake" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                            <label for="category" class="col-md-4 control-label">Categorie :   </label>

                            <div class="col-md-6">
                                <input id="category " type="text" class="form-control" name="category" placeholder="Deserts" required>

                                @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Descriere :</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control" name="description" rows="4" required></textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-4 control-label">Imagine :</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control-file" name="image">

                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">
                            <label for="time" class="col-md-4 control-label">Timp de lucru necesar ( in minute ) :</label>

                            <div class="col-md-6">
                                <input id="time" type="number" class="form-control" name="time" required>
                                @if ($errors->has('time'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('time') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                          <div class="form-group{{ $errors->has('difficulty') ? ' has-error' : '' }}">
                            
                            <label for="difficulty" class="col-md-4 control-label">Dificultate :</label>
                            <div class="col-md-2"></div>
                            <div id="slider" class="col-md-2">
                               <input id="difficulty" type="range" class="ange-slider__range" name="difficulty" min="1" max="10" value="5" onchange="changeVal(this.value)" oninput="showVal(this.value)" >

                                @if ($errors->has('difficulty'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('difficulty') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-1">
                               <span id="slider-span">5</span>
                               </div>
                        <hr class="col-md-6">
                        </div>

                       

                        <div id="ingredients-form-div" class="form-group ">

                        <div class="ingredient">
                         <label for="ingredient1" class="col-md-4 control-label">Ingredient 1 :</label>

                            <div class="col-md-2">
                            <input id="ingredient-name-1" name="name-1" type="text" class="ingredient-name form-control"  required>
                              <small class="form-text text-muted" >Ingredient name</small>
                            </div>
                              <div class="col-md-2">
                            <input id="ingredient-quantity-1" name="quantity-1" type="number" class="ingredient-quantity form-control"  required>
                              <small class="form-text text-muted" >Quantity </small>
                            </div>
                               <div class="col-md-2">
                            <textarea id="ingredient-description-1" name="description-1" class="ingredient-description form-control"></textarea>
                              <small class="form-text text-muted" >Optional description*</small>
                            </div>
                                <div class="col-md-2">
                                <button class="btn btn-default minus" type="button" onclick="removeIngredientForm(0)">x</button>
                                </div>
                                </div>

                                <div id="btndiv">
                                <label for="plusButton" class="col-md-4 control-label"></label>
                                <div class="col-md-3"></div>
                                <div class="col-md-2">
                                <button class="btn btn-default plus" type="button" onclick="addNewIngredientForm()">+</button>
                                </div>
                                </div>

                            <div class="col-md-4"></div>
                            <hr class="col-md-6">
                            </div>

                            <div id="steps-form-div" class="form-group">

                            <div class="step">
                            <label for="step1" class="col-md-4 control-label">Pasul 1 :</label>

                            <div class="col-md-6">
                            <textarea id="step-1" name="step-1" rows=2 class="step-input form-control"></textarea> 
                            </div>

                            <div class="col-md-2">
                                <button class="btn btn-default minus-step" type="button" onclick="removeStepAt(0)">x</button>
                                </div>
                                </div>

                             <div id="btndiv2">
                                <label for="plusButton" class="col-md-4 control-label"></label>
                                <div class="col-md-3"></div>
                                <div class="col-md-2">
                                <button class="btn btn-default plus2" type="button" onclick="addNewStepForm()">+</button>
                                </div>
                                </div>

                            </div>

                            <div class="form-group">
                            <label class="col-md-4 control-label">Vizibilitate la publicul larg :</label>
                            <div class="col-md-2">
                                    <input type="checkbox" class="checkbox-inline" name="public" value="yes" checked> Reteta publica 
                            </div>
                            <div class="col-md-2"><input class="btn btn-primary saverecipe" type="submit" value="Salveaza reteta"></div>
                            </div>

                                                </form>

@endsection