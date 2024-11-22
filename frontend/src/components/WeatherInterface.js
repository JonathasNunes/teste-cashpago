import React, { useState } from 'react';
import './WeatherInterface.css';
import SearchBar from '../components/SearchBar/SearchBar';
import InfoCard from '../components/InfoCard/InfoCard';
import WeatherService from '../service/WeatherService';

const WeatherInterface = () => {
  const [city, setCity] = useState(''); // Armazena a cidade
  const [loading, setLoading] = useState(false); // Indica carregamento

  const handleSearch = async (searchCity) => {
    setCity(searchCity);
    setLoading(true); // Exibe o estado de carregamento

    try {
      const weatherData = await WeatherService.getWeatherByCity(searchCity);
      console.log(weatherData); // Exibimos os dados no console por enquanto
    } catch (error) {
      console.error('Erro ao buscar o clima:', error);
    } finally {
      setLoading(false); // Encerra o estado de carregamento
    }
  };

  return (
    <div className="container">
      <SearchBar  onSearch={handleSearch} />
      {loading && <p>Carregando...</p>} {/* Mostra carregamento */}
      <InfoCard />
    </div>
  );
};

export default WeatherInterface;
