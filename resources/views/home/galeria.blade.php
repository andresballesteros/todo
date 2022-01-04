<div class="tituloSeccionNoticias" style="width: 100%">
    <h2>GALERÍA</h2>
</div>
<section class="galerias">
    <div class="row masonry masonry--h p-0">
        <div class="d-flex col-md-8 p-0">

            <figure class="masonry-brick masonry-brick--h">
                <a
                    href="{{ route('galeria.show', ['galeria' => $galerias[0], 'title' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $galerias[0]->title), '-'))]) }}">

                    <img src="<?= str_replace('public://', 'https://fontur.com.co/sites/default/files/', $galerias[0]->img) ?>" class="masonry-img" alt="">
                        <figcaption>
                            {{ $galerias[0]->title }}    
                        </figcaption>
                    </a>
            </figure>
         
                                    
            <figure class="masonry-brick masonry-brick--h">
                <a href="{{ route('galeria.show', ['galeria' => $galerias[1], 'title' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $galerias[1]->title), '-'))]) }}">
                <img src="<?= str_replace('public://', 'https://fontur.com.co/sites/default/files/', $galerias[1]->img) ?>" class="masonry-img" alt="">
                <figcaption>
                    {{ $galerias[1]->title }}    
                </figcaption>
                </a>
            </figure>
            
        </div>
        <div class="d-block col-md-4 p-0">

                                    
            <figure class="masonry-brick2 masonry-brick--h">
                <a href="{{ route('galeria.show', ['galeria' => $galerias[2], 'title' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $galerias[2]->title), '-'))]) }}">
                    <img src="<?= str_replace('public://', 'https://fontur.com.co/sites/default/files/', $galerias[2]->img) ?>" class="masonry-img" alt="">
                        <figcaption>
                            {{ $galerias[2]->title }}    
                        </figcaption>
                </a>
            </figure>
            
                
            
            <figure class="masonry-brick2 masonry-brick--h">
                <a href="{{ route('galeria.show', ['galeria' => $galerias[3], 'title' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $galerias[3]->title), '-'))]) }}">
                    <img src="<?= str_replace('public://', 'https://fontur.com.co/sites/default/files/', $galerias[3]->img) ?>" class="masonry-img" alt="">
                    <figcaption>
                        {{ $galerias[3]->title }}    
                    </figcaption>
                </a>
            </figure>
                            
        </div>
        </div>
    </section>
