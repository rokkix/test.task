<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
   
   <script type="text/javascript" src="App/Views/admin/js/linkedselect.js"></script>
	
</head>
<div class="container">

    <article style="margin: 10%">
        <section style="padding-right: 20%">
            <?php $pagetitle = !empty($ad->id) ? 'Редактирование' : 'Добавление обявление' ?>
            <h1> <?php echo $pagetitle; ?> <i style="color: green"><?php echo $ad->name; ?></i></h1>
			
		
            <form method="post" action="/?act=save&ctrl=admin" enctype="multipart/form-data">
			<input type="file" name="image_upload"><br> 
			
                <h3>Объявление</h3>
                <input type="hidden" name="id" value="<?php echo $ad->id; ?>">
                <select class="form__select" name="name" id="List1">
					<?php if (!empty($ad->id)): ?>
                        <option value="<? echo $ad->name ?>"><?php echo $ad->name ?></option>
					<?php endif ?>	
						<option value="Citroen">Citroen</option>
						<option value="Audi">Audi</option>
						<option value="BMW">BMW</option>
						<option value="Mercedes">Mercedes</option>
						<option value="Chrysler">Chrysler</option>
						<option value="Fiat">Fiat</option>
						<option value="Ford">Ford</option>
						<option value="Honda">Honda</option>
						<option value="Hyundai">Hyundai</option>
						<option value="Kia">Kia</option>
						<option value="Mazda">Mazda</option>
						<option value="Nissan">Nissan</option>
						<option value="Chevrolet">Chevrolet</option>
						
                 </select>
				<select class="form__select" name="model" id="List2">
					<?php if (!empty($ad->id)): ?>
                        <option value="<? echo $ad->model ?>"><?php echo $ad->model ?></option>
					<?php endif ?>	
                       
                 </select>
				 <select class="form__select" name="type_fuel" id="fuel">
					<?php if (!empty($ad->id)): ?>
                        <option value="<? echo $ad->type_fuel ?>"><?php echo $ad->type_fuel ?></option>
					<?php endif ?>	
                        <option>Бензин</option>
                        <option>Газ</option>
                 </select>
				  <select class="form__select" name="korobka" id="fuel">
					<?php if (!empty($ad->id)): ?>
                        <option value="<? echo $ad->korobka ?>"><?php echo $ad->korobka ?></option>
					<?php endif ?>	
                        <option>Механика</option>
                        <option>Автомат</option>
                 </select>
				 <select class="form__select" name="kuzov" id="fuel">
					<?php if (!empty($ad->id)): ?>
                        <option value="<? echo $ad->kuzov ?>"><?php echo $ad->kuzov ?></option>
					<?php endif ?>	
                        <option>Вседорожный</option>
                        <option>Седан</option>
                        <option>Универсал</option>
                 </select>
				  <select class="form__select" name="privod" id="fuel">
					<?php if (!empty($ad->id)): ?>
                        <option value="<? echo $ad->privod ?>"><?php echo $ad->privod ?></option>
					<?php endif ?>	
                        <option>Постоянный полный</option>
                        <option>Подключаемый полный полный</option>
                        <option>Задний</option>
                 </select>
				  <h4>Цена</h4>
				  <p><input type="number" name="price" value="<?php echo $ad->price ?>"/> $</p>
				  <h4>Артикл</h4>
				  <p><input type="number" name="artil" value="<?php echo $ad->artil ?>"/></p>
				  <h4>Год выпуска</h4>
				  <p><input type="number" name="date" value="<?php echo $ad->date ?>"/></p>
				  <h4>Отметить как новинка</h4>
				  <p><input type="radio" name="flag" value="1"/>ДА
				   <input type="radio" name="flag" value="0"/>НЕТ</p>
				 
                <h3>Описание</h3>
                <p><textarea cols="100" rows="4" name="description"><?php echo $ad->description; ?></textarea></p>

                <button type="submit" style="background-color: green">Сохранить</button>
                <button type="reset" style="background-color: aliceblue"><a
                        href="/?ctrl=admin">Отменить</a></button>

            </form>
            <?php if (!empty($id)): ?>
                <p style="margin-bottom: 2px"><b>Опубликовано:</b> <?php echo $article->published; ?></p>
                <p style="margin-top: 2px "><b>Автор:</b> Петров пётр</p>
            <?php endif ?>
			
			<script type="text/javascript">

var syncList1 = new syncList;


syncList1.dataList = {



  'Citroen':{
	  
	  '<? if ($ad->name == 'Citroen') echo $ad->model;?>':'<? if ($ad->name == 'Citroen') echo $ad->model;?>',
      'AX':'AX',
      'C5':'C5',
      'C4':'C4',
      'C8':'C8',
      'Voyager':'Voyager',
  },
  
  'Chrysler':{
	  '<? if ($ad->name == 'Chrysler') echo $ad->model;?>':'<? if ($ad->name == 'Chrysler') echo $ad->model;?>',
      'Pacifica':'Pacifica',
      'Voyager':'Voyager',
      'Sebring':'Sebring',
  },
  
  'Hyundai':{
	  '<? if ($ad->name == 'Hyundai') echo $ad->model;?>':'<? if ($ad->name == 'Hyundai') echo $ad->model;?>',
      'Sporatge':'Sporatge',
      'Santa Fe':'Santa Fe',
      'Solaris':'Solaris',
      'i30':'i30',
  },
  
  'BMW':{
	  '<? if ($ad->name == 'BMW') echo $ad->model;?>':'<? if ($ad->name == 'BMW') echo $ad->model;?>',
      '3-series':'3-series',
      '1-series':'1-series',
      '5-series':'5-series',
      'X3':'X3',
  },
  
  'Kia':{
	  '<? if ($ad->name == 'Kia') echo $ad->model;?>':'<? if ($ad->name == 'Kia') echo $ad->model;?>',
      'Rio':'Rio',
      'Optima':'Optima',
      'Sporatge':'Sporatge',
      'Ceed':'Ceed',
  },
    
  'Honda':{
	  '<? if ($ad->name == 'Honda') echo $ad->model;?>':'<? if ($ad->name == 'Honda') echo $ad->model;?>',
      'Civic':'Civic',
      'Accord':'Accord',
      'Jazz':'Jazz',
  },
  
  'Fiat':{
	  '<? if ($ad->name == 'Fiat') echo $ad->model;?>':'<? if ($ad->name == 'Fiat') echo $ad->model;?>',
      'Punto':'Punto',
      'Stilo':'Stilo',
      'Marea':'Marea',
  },
  
  'Ford':{
	  '<? if ($ad->name == 'Ford') echo $ad->model;?>':'<? if ($ad->name == 'Ford') echo $ad->model;?>',
      'Mondeo':'Mondeo',
      'Focus':'Focus',
      'Fiesta':'Fiesta',
  },
  
  'Mazda':{
	  '<? if ($ad->name == 'Mazda') echo $ad->model;?>':'<? if ($ad->name == 'Mazda') echo $ad->model;?>',
      '3':'3',
      '6':'6',  
  },
  
    'Nissan':{
	  '<? if ($ad->name == 'Nissan') echo $ad->model;?>':'<? if ($ad->name == 'Nissan') echo $ad->model;?>',
      'Almera':'Almera',
      'Primera':'Primera',
      'Juke':'Juke',
  },
	
  'Mercedes':{
	  '<? if ($ad->name == 'Mercedes') echo $ad->model;?>':'<? if ($ad->name == 'Mercedes') echo $ad->model;?>',
      'C-klasse (W202)':'C-klasse (W202)',
      'ML-klasse':'ML-klasse',
  },
  
  'Chevrolet':{
	  '<? if ($ad->name == 'Chevrolet') echo $ad->model;?>':'<? if ($ad->name == 'Chevrolet') echo $ad->model;?>',
      'Cruze':'Cruze',
      'Captiva':'Captiva',  
  },
  
  'Audi':{
	  '<? if ($ad->name == 'Audi') echo $ad->model;?>':'<? if ($ad->name == 'Audi') echo $ad->model;?>',
       'A1':'A1',
       'A3':'A3',
       'A4':'A4',
       'A6':'A6',
       'Q5':'Q7'
  }
  };




syncList1.sync("List1","List2");
</script>
        </section>
    </article>
</div>
</html>

