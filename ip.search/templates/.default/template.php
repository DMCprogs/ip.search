<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
      CJSCore::Init(array("jquery"));
	//  var_dump($arParams);
 ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<main role="main" class="container main-wrapper">
			<div class="row">
				<div class="col-md-8 order-md-2 mb-4">
					<h4 class="d-flex justify-content-between align-items-center mb-3">
						<span class="text-muted">Данные ip</span>
					</h4>
					<div class="form-group">
						<textarea id="sync_log" class="form-control textarea-logs synclog" placeholder="Пусто" readonly></textarea>
					</div>
					
					
				</div>
				<div class="col-md-4 order-md-1">
					<h4 class="mb-3">Рабочая область</h4>
					<div class="form-group">
				Введите ip
						<input name="ip" class="form-control ip-input">
					
					
				</div>
				<button class="btn btn-primary btn-sm ajax-btn" type="submit">Получить информацию</button>
				<div style="margin-top: 20px;" class="text-danger" ></div>
			</div>
				</div>
			</div>
		</main>
		

				
<script>
			ipsearch.init({
				frontfile: "<?=$templateFolder?>",
				idHigload:"<?=$arParams["ID_HIGLOAD"]?>",
				ipServic:"<?=$arParams["OPTION_SELECTION"]?>",
			});
		</script>
		

		<!-- /Templates -->

	
	