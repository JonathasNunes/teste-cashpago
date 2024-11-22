import React from 'react';
import './WeatherInterface.css';
import SearchBar from '../components/SearchBar/SearchBar';
import InfoCard from '../components/InfoCard/InfoCard';

const WeatherInterface = () => {
  return (
    <div className="container">
      <SearchBar />
      <InfoCard />
    </div>
  );
};

export default WeatherInterface;
