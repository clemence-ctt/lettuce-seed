# Lettuce seed

## MCD

### user => plant 0,n 

un user peut n'avoir aucune plante enregistrée, ou en avoir vers l'infini et au-delà.

### plant => user 1,1

une plante n'appartient qu'à un utilisateur, et ne peut pas être orpheline. 

### plant => picture 0,n

une plante peut ne pas être encore documentée (0 photo), ou avoir une infinité de photos.

### picture => plant 1,n

une photo est rattachée à une plante au minimum, mais peut aussi être rattachée à plusieurs (au cas où plusieurs plantes soient sur la même photo). 
