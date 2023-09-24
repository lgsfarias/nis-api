'use client';

import { useState } from 'react';
import CitizenForm from '../components/CitizenForm';
import SearchNISForm from '../components/SearchNisForm';
import { formatNIS } from '@/utils/nisUtils';

const Home = () => {
  const [message, setMessage] = useState({
    status: '',
    message: '',
  });

  const formatMessage = (message: string) => {
    return message;
  }
  const handleCitizenSubmit = async (name: string) => {
    try {
      const response = await fetch('/api/citizen', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ name }),
      });

      const data = await response.json();

      if (!response.ok) {
        setMessage({
          status: 'error',
          message: data.message || 'Erro ao cadastrar cidadão.',
        });
        return;
      }

      if (data.nis) {
        setMessage({
          status: 'success',
          message: `O Cidadão ${data.name} foi cadastrado com sucesso com o NIS ${formatNIS(data.nis)}`,
        });
      }
    } catch (error) {
      setMessage({
        status: 'error',
        message: 'Ocorreu um erro inesperado.',
      });
    }
  };

  const handleSearchNIS = async (nis: string) => {
    try {
      const response = await fetch(`/api/citizen/${nis}`);
      const data = await response.json();

      if (!response.ok) {
        setMessage({
          status: 'error',
          message: data.message || 'Erro ao buscar cidadão.',
        });
        return;
      }

      if (data.name) {
        setMessage({
          status: 'success',
          message: `O Cidadão ${data.name} possui o NIS ${formatNIS(nis)}`,
        });
      } else {
        setMessage({
          status: 'error',
          message: `Nenhum cidadão encontrado com o NIS ${nis}`,
        });
      }
    } catch (error) {
      setMessage({
        status: 'error',
        message: 'Ocorreu um erro inesperado.',
      });
    }
  };

  return (
    <div className="App bg-gray-200 h-screen py-12">
      <div className="container max-w-screen-md m-auto p-8 bg-white rounded-xl">
      <h1 className="text-6xl font-black tracking-tighter">
          Cadastro NIS
      </h1>
      <CitizenForm onSubmit={handleCitizenSubmit} />
      <SearchNISForm onSearch={handleSearchNIS} />
      {message.message && (
        <div
          className={`mt-4 p-4 rounded ${
            message.status === 'error' ? 'bg-red-600' : 'bg-green-600'
          }`}
        >
          <p className="text-white">{message.message}</p>
        </div>
      )}
      </div>
    </div>
  );
};

export default Home;
