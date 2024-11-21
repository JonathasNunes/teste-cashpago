import React from 'react';
import './WeatherInterface.css';

const WeatherInterface = () => {
  return (
    <div className="container">
      {/* Barra de pesquisa */}
      <div className="search-bar">
        <input type="text" placeholder="Pesquisar por localidade" />
      </div>

      {/* Quadro de informações */}
      <div className="info-card">
        {/* Imagem de nuvens */}
        <div className="cloud-image">
          <img src="assets/weather.png" alt="clouds" />
        </div>

        {/* Informar local pesquisado */}
        <div className="location">
            <img src="assets/image-4.png" alt="location" className="location-img" />
            <span>Rio do Sul, SC</span>
        </div>

        {/* Temperatura e Local */}
        <div className="info-content">
          <div className="temperature">18<sup>°C</sup></div>
        </div>

        {/* Seções de detalhes (vento, etc.) */}
        <div className="details">
            <div key="1" className="detail-section">
              <img src="assets/image-1.png" alt="Vento" className="detail-icon" />
              <div className="detail-text">
                <div className="detail-type">Vento</div>
                <div className="detail-value">17km/h</div>
              </div>
            </div>

            <div key="2" className="detail-section">
              <img src="assets/image-2.png" alt="Umidade" className="detail-icon" />
              <div className="detail-text">
                <div className="detail-type">Umidade</div>
                <div className="detail-value">31%</div>
              </div>
            </div>

            <div key="3" className="detail-section">
              <img src="assets/image-3.png" alt="Chuva" className="detail-icon" />
              <div className="detail-text">
                <div className="detail-type">Chuva</div>
                <div className="detail-value">10%</div>
              </div>
            </div>
        </div>
      </div>
    </div>
  );
};

export default WeatherInterface;
