<div class="tituloSeccionNoticias" style="width: 100%">
    <h2>CONOCE LAS ÚLTIMAS NOTICIAS</h2>
</div>
<div class="news d-flex justify-content-between row p-0">
    @foreach ($noticias as $noticia)
        <div class="noticiasDiv col-md-6 p-0">
            <a
                href="{{ route('noticia.show', ['noticia' => $noticia, 'title' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $noticia->title), '-'))]) }}">
                <img src=" <?= str_replace('public://', 'https://fontur.com.co/sites/default/files/', $noticia->img) ?>" alt="">
                    <h1>{{ $noticia->title }}</h1>
                </a>
            </div>
            @endforeach
    
    </div>
