<?php

use App\Models\Noticia;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/', function () {
    return view('home');
})->name('home');

Route::view('/teste', 'tela-teste');

Route::view('/cadastro', 'tela-cadastro')->name('telaCadastro');

Route::view('/login', 'login')->name('login');

Route::post('/salva-usuario', 
    function (Request $request){
        $user = new User();
        $user->name = $request->nome;
        $user->email = $request->email;
        $user->password = $request->senha;
        $user->save();

        return redirect()->route('home');
    }
)->name('SalvaUsuario');

Route::post('/logar', 
    function (Request $request){

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/');
        }
 
        return back()->withErrors([
            'email' => 'Usuário e senha inválidos.',
        ])->onlyInput('email');
    }
)->name('logar');

Route::get('/logout',

    function(Request $request){
        Auth::logout();
        $request->session()->regenerate();
        return redirect()->route('home');
    }
)->name('logout');

Route::get('/gerencia-noticias', function () {

    $noticias = Noticia::orderBy('id', 'desc')->get();
    return view('gerencia-noticias', compact('noticias'));

}

)->name('gerenciaNoticias');

Route::get('/cadastra-noticia',
function(){
    $noticia = new Noticia();
    return view('cadastra-noticia', compact('noticia'));
}
)->name('cadastraNoticia');
route::post( '/salva-noticia', 
    function(Request $request){
        dd($request);
        // $user = new User();
        // $user->name =$request->nome;
        // $user->email =$request->email;
        // $user->password =$request->senha;
        // $user->save();
        return redirect()->route('home');
    }
)
->name('SalvaNoticia');
route::post( '/salva-noticia', 
    function(Request $request){
        $noticia = new Noticia();
        $noticia->titulo = $request ->titulo;
        $noticia->resumo = $request ->resumo;
        $noticia->capa = $request ->capa;
        $noticia->conteudo = $request ->conteudo;
        $noticia->data = now();
        $noticia->user_id = Auth::id();
        $noticia->save();
      
        return redirect()->route('gerenciaNoticias');
    }
)
->name('SalvaNoticia');
route::get('/exibir-noticia/{noticia}',
     function(Noticia $noticia){
            return view('exibir-noticia', compact('noticia'));
     }
     )->name('exibirNoticia');
     route::get('/edita-noticia/{noticia}',
     function(Noticia $noticia){
            return view('edita-noticia', compact('noticia'));
     }
     )->name('editaNoticia');
     route::post( '/altera-noticia/{noticia}', 
    function(Request $request, Noticia $noticia) {
        $noticia = new Noticia();
        $noticia->titulo = $request ->titulo;
        $noticia->resumo = $request ->resumo;
        $noticia->capa = $request ->capa;
        $noticia->conteudo = $request ->conteudo;
        $noticia->data = now();
        $noticia->user_id = Auth::id();
        $noticia->save();
      
        return redirect()->route('gerenciaNoticias');
    }
)
->name('alteraNoticia');
    
route::get('/deleta-noticia/{noticia}',
     function(Noticia $noticia){
        $noticia->delete();
            return redirect()->route('gerenciaNoticias');
     }
     )->name('deletaNoticia');






