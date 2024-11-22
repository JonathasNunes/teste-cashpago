import React, { useState } from 'react';
import './SearchBar.css';

const SearchBar = ({ onSearch }) => {
  const [searchValue, setSearchValue] = useState('');

  const handleInputChange = (e) => {
    setSearchValue(e.target.value);
  };
  
  const handleKeyPress = (e) => {
    if (e.key === 'Enter' && searchValue.trim()) {
        onSearch(searchValue); // Passa o valor da cidade ao componente pai
    }
  };

  return (
    <div className="search-bar">
      <input 
        type="text" 
        placeholder="Pesquisar por localidade"
        value={searchValue}
        onChange={handleInputChange}
        onKeyDown={handleKeyPress} // Detecta a tecla Enter
     />
    </div>
  );
};

export default SearchBar;
