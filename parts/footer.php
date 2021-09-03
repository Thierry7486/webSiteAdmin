<div class="foot">
    <p class="text-center h6 <?=(strpos($_SERVER["PHP_SELF"],"admin"))?"bg-danger":"bg-light"?>">&copy; Webforce - <?=date("Y")?></p>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script>
        var app;

        function initPixi() {
            app = new PIXI.Application({
                width: window.innerWidth,
                height: window.innerHeight
            });
            document.body.appendChild(app.view);
            var image = new PIXI.Sprite.from("./assets/images/<?=$img?>");
            image.width = window.innerWidth;
            image.height = window.innerHeight;
            app.stage.addChild(image);
            displacementSprite = new PIXI.Sprite.from("./assets/background/cloud.jpg");
            displacementFilter = new PIXI.filters.DisplacementFilter(displacementSprite);
            displacementSprite.texture.baseTexture.wrapMode = PIXI.WRAP_MODES.REPEAT;
            app.stage.addChild(displacementSprite);
            app.stage.filters = [displacementFilter];
            app.renderer.view.style.transform = 'scale(1.02)';
            displacementSprite.scale.x = 4;
            displacementSprite.scale.y = 4;
            animate();
        }

        function animate() {
            displacementSprite.x += 10;
            displacementSprite.y += 4;
            requestAnimationFrame(animate);
        }
        initPixi();
    </script>
	