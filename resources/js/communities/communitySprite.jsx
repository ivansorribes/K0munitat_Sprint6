import React from 'react';
import '../../css/community.css';

const CommunitySprite = ({ communityId }) => {
  // Calcula el nombre de la clase CSS según el ID de la comunidad
  const getSpriteClass = (id) => {
    switch (id) {
      case 1:
        return 'spritesdef-Andalucia';
      case 2:
        return 'spritesdef-Aragon';
      case 3:
        return 'spritesdef-Asturias';
      case 4:
        return 'spritesdef-Cantabria';
      case 5:
        return 'spritesdef-Castilla-La_Mancha';
      case 6:
        return 'spritesdef-Castilla_y_Leon';
      case 7:
        return 'spritesdef-Cataluna';
      case 8:
        return 'spritesdef-Ceuta';
      case 9:
        return 'spritesdef-Comunidad_Valenciana';
      case 10:
        return 'spritesdef-Comunidad_de_Madrid';
      case 11:
        return 'spritesdef-Extremadura';
      case 12:
        return 'spritesdef-Galicia';
      case 13:
        return 'spritesdef-Islas_Baleares';
      case 14:
        return 'spritesdef-Islas_Canarias';
      case 15:
        return 'spritesdef-La_Rioja';
      case 16:
        return 'spritesdef-Melilla';
      case 17:
        return 'spritesdef-Murcia';
      case 18:
        return 'spritesdef-Navarra';
      case 19:
        return 'spritesdef-Pais_Vasco';
      default:
        return '';
    }
  };

  // Obtiene la clase CSS correspondiente al ID de la comunidad
  const spriteClass = getSpriteClass(communityId);

  return <div className={`spritesdef ${spriteClass}`}></div>;
};

export default CommunitySprite;
