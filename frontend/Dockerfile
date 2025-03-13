# Use a imagem base do Node.js
FROM node:22-alpine

# Defina o diretório de trabalho dentro do contêiner
WORKDIR /app

# Copie os arquivos de package.json e package-lock.json
COPY package*.json ./

# Instale as dependências
RUN npm install

# Copie o restante do código do projeto
COPY . .

# Compile o projeto para produção
RUN npm run build

# Expõe a porta 5173 (ou a porta que você usa no Vue)
EXPOSE 5173

# Comando para rodar o servidor de desenvolvimento com a opção --host
CMD ["npm", "run", "dev", "--", "--host"]