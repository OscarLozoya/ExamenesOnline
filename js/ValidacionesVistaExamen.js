var segundos=0,
	minutos=0,
	horas=0;
function IniciaTiempo()
{
	setInterval(Temporizador,1000);
}

function Temporizador()
{
	var time=$('h1#tiempoRestante'),
		hora=time.text().split(":");
	horas=parseInt(hora[0]);
	minutos=parseInt(hora[1]);
	segundos=parseInt(hora[2]);

	
	if(segundos==0)
	{
		segundos=59;
		minutos-=1;
		if(minutos==0&&horas>0)
		{
			minutos=59;
			horas-=1;
		}
	}
	else
		segundos-=1;

	if(segundos==0&&minutos==0&&segundos==0)
	{
		$.ajax({
			type: 'POST',
			data: $('#formulario').serialize(),
			url: window.location.href,
			success:function(data){window.location="index.php";}
		});
	}
	else
	{
		if(segundos<10)
			segundos="0"+segundos;
		if(minutos<10)
			minutos="0"+minutos;
		if(horas<10)
			horas="0"+horas;
		time.text(horas+":"+minutos+":"+segundos);
	}
}