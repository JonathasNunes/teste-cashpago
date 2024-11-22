import React, { useState, useEffect } from 'react';
import './WeatherInterface.css';
import SearchBar from '../components/SearchBar/SearchBar';
import InfoCard from '../components/InfoCard/InfoCard';
import WeatherService from '../service/WeatherService';

const WeatherInterface = () => {
  const [weatherData, setWeatherData] = useState(null); // Estado para dados do clima
  const [loading, setLoading] = useState(false); // Indica carregamento

  // Função para buscar o clima por cidade
  const fetchWeather = async (city) => {
    setLoading(true);
    try {
      const data = await WeatherService.getWeatherByCity(city);
      setWeatherData(data); // Armazena os dados da API
    } catch (error) {
      console.error('Erro ao buscar o clima:', error);
    } finally {
      setLoading(false);
    }
  };

  // Busca inicial para "São Paulo" quando abrir pela primeira vez sem consulta
  useEffect(() => {
    fetchWeather('São Paulo');
  }, []);

  const handleSearch = async (searchCity) => {
    fetchWeather(searchCity);
  };

  return (
    <div className="container">
      <SearchBar onSearch={handleSearch} />
      {loading && <p>Carregando...</p>}
      {weatherData && (
        <InfoCard
          cityCountry={weatherData.cidade_pais}
          temperature={weatherData.temperatura_atual}
          details={[
            { id: 1, icon: 'assets/image-1.png', type: 'Vento', value: `${weatherData.velocidade_vento} km/h` },
            { id: 2, icon: 'assets/image-2.png', type: 'Umidade', value: `${weatherData.humidade_relativa}%` },
            { id: 3, icon: 'assets/image-3.png', type: 'Chuva', value: weatherData.descricao_clima },
          ]}
        />
      )}
    </div>
  );
};

export default WeatherInterface;