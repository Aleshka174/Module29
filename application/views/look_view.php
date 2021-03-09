<div class="container pt-4">
    <?php if ($_SESSION['auth'] == true): ?>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ratione rerum possimus sed consequatur iste voluptas amet veniam quo dolore temporibus vel corrupti eveniet hic unde, harum ullam repellendus sapiente velit quidem. Vero quod exercitationem iste et, impedit ex, fugit asperiores fuga dolorum obcaecati perferendis. Magnam odit modi, tempora unde tempore earum nihil doloribus molestiae sequi amet pariatur officiis possimus alias rerum nesciunt eaque accusamus aspernatur laudantium iste eius suscipit. Modi, cumque. Voluptatibus saepe natus consectetur. Voluptatum ex dolore dicta vel, officiis repellat quos sunt modi magnam dolores, quas corrupti dolorum libero, quam, ipsam. Cum, nisi, sed, vitae accusantium nesciunt consequuntur minima hic necessitatibus harum, qui doloribus magni a at molestiae earum iusto? Dolor non numquam, harum ab cupiditate, beatae saepe laborum ad sed. Deserunt minus unde officiis fugiat dolorum vitae ut suscipit, ipsa, obcaecati, eligendi eos aliquid velit, sint consectetur. Consectetur facilis nostrum non ipsam asperiores esse odit, hic sit qui aspernatur, nesciunt culpa dolore. Nostrum voluptatem atque, aspernatur temporibus iure asperiores, molestiae ipsum adipisci doloremque necessitatibus at debitis enim tempore accusantium nesciunt, velit minima iusto sunt rerum! Placeat suscipit voluptatibus repellat ipsum dolores fugit quae, eaque quaerat debitis dolore facere. Ullam dolores nisi fugiat, dolorum ipsa quidem culpa exercitationem possimus, officia blanditiis fuga, vero quis obcaecati itaque, labore facilis magnam distinctio quae. Incidunt non sit animi at beatae consequatur eveniet, et? Consequuntur ab modi quaerat eos, illo, culpa est! Maxime ratione beatae, veritatis magni voluptate quas accusamus natus numquam, est cupiditate. Ab harum eaque accusantium sed quibusdam voluptatibus excepturi.</p>

        <?php if (isset($_SESSION['token'])): ?>
          <img src="/public/images/Lighthouse.jpg" alt="картинка для ВК">  
        <?php endif ?>
        <Button type="button" class="btn btn-outline-warning"><a href="/logout">Выйти</a></Button>
    <?php else: ?>
        <p>Вы не авторизовались! Можете перейти на основную страницу и зарегистрироваться для просмотра контента!</p>
        <Button type="button" class="btn btn-outline-warning"><a href="/main">Перейти на основную страницу!</a></Button>
    <?php endif ?>
</div>
