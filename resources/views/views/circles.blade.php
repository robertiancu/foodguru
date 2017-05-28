@extends ('layouts.main')

@section ('content')

    <h1 class="page-header">Cercurile mele</h1>
     
    <div id="circle-create">
    <a id="circle-create-link" onclick="createCircleForm(this)">
        Creeaza un cerc
    </a>
    </div><br>
    @foreach ($circles as $circle)
        
        <a href="/view/circle/{{ $circle->id }}" class="circle">
        <ul>
            
            <li title="{{ $circle->owner->first_name }} {{ $circle->owner->last_name }}">
                <img src="{{ $circle->owner->profileImageRoute() }} " alt="Error" width="30">
                <span><b>{{ $circle->owner->first_name }}</b></span>
            </li>
            @foreach ($circle->users->where("id","<>",$circle->user_id)->take(3)->all() as $user)

                
                <li title="{{ $user->first_name }} {{$user->last_name}}">
                    <img src="{{ $user->profileImageRoute() }} " alt="Error">
                    <span>{{ $user->first_name }}</span>
                </li>

            @endforeach

        </ul>
        <span>{{ $circle->name }}</span>
        </a>
    @endforeach

@endsection

@section ('scripts')

   <script>
        function createCircleForm(){
            var d=document.getElementById("circle-create");
            d.removeChild(document.getElementById("circle-create-link"));
            var f=document.createElement("form");
            f.setAttribute("method","POST");
            f.setAttribute("action","/circle");
            var h=document.createElement("input");
            h.setAttribute("type","hidden");
            h.setAttribute("name","_token")
            h.setAttribute("value","{{ csrf_token() }}");
            var i=document.createElement("input");
            i.setAttribute("type","text");
            i.setAttribute("name","name");
            i.setAttribute("placeholder","Numele cercului");
            var s=document.createElement("button");
            s.setAttribute("type","submit");
            s.setAttribute("name","submit");
            s.setAttribute("value","Creeaza!");
            s.innerText="Creeaza!";
            f.appendChild(h);
            f.appendChild(i);
            f.appendChild(s);
            var b=document.createElement("button");
            b.classList.add("glyphicon","glyphicon-remove","btn","btn-danger");
            b.addEventListener("click",destroyCircleForm);
            d.appendChild(f);
            d.appendChild(b);
        }
        function destroyCircleForm(){
            var d=this.parentElement;
            d.removeChild(d.lastChild);
            d.removeChild(d.lastChild);
            var a=document.createElement("a");
            a.addEventListener("click",createCircleForm);
            a.innerText="Creeaza un cerc";
            a.id="circle-create-link";
            d.appendChild(a);
        }
    </script> 

@endsection
