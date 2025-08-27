import React, { useEffect, useState } from 'react';
import axios from 'axios';

const OwnerPets = () => {
  const [pets, setPets] = useState([]);

  useEffect(() => {
    axios.get('/api/owner/pets')
      .then(res => setPets(res.data))
      .catch(err => console.error(err));
  }, []);

  return (
    <div>
      <h5>Your Pets</h5>
      <ul className="list-group">
        {pets.map(pet => (
          <li key={pet.id} className="list-group-item">
            {pet.name} ({pet.species})
          </li>
        ))}
      </ul>
    </div>
  );
};

export default OwnerPets;