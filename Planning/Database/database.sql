-- Users Table: Stores user information
CREATE TABLE Users (
    id                  INT             AUTO_INCREMENT PRIMARY KEY, -- user id
    username            VARCHAR(50)     NOT NULL,                   -- The username of the user
    password            VARCHAR(255)    NOT NULL,                   -- The password of the user
    email               VARCHAR(100)    NOT NULL,                   -- The email of the user
    registration_date   DATETIME        DEFAULT CURRENT_TIMESTAMP   -- The date the user registered
);

-- GameIdeas Table: Stores basic information about each game idea
CREATE TABLE GameIdeas (
    id              INT             AUTO_INCREMENT PRIMARY KEY,     -- game idea id
    user_id         INT,                                            -- user id foreign key to track the user that creates the idea
    title           VARCHAR(100)    NOT NULL,                       -- Title of the idea
    cover_image_url TEXT            NOT NULL,                       -- URL to the cover image
    post_date       DATETIME        DEFAULT CURRENT_TIMESTAMP,      -- Date the comment is made and posted

    FOREIGN KEY (user_id) REFERENCES Users(id)                      -- foreign key id
);

-- Genres Table: Stores a list of available genres
CREATE TABLE Genres (
    id      INT         AUTO_INCREMENT PRIMARY KEY,                 -- genre id
    name    VARCHAR(50) NOT NULL                                    -- name of genres
);

-- GameIdeaGenres Table: Links game ideas to genres (many-to-many relationship)
CREATE TABLE GameIdeaGenres (
    id              INT AUTO_INCREMENT PRIMARY KEY,                 -- gameideagenre id
    game_idea_id    INT,                                            -- foreign key from gameIdeas table
    genre_id        INT,                                            -- foreign key from genres table
    FOREIGN KEY (game_idea_id)  REFERENCES GameIdeas(id),           -- same
    FOREIGN KEY (genre_id)      REFERENCES Genres(id)               -- same
);

-- Sections Table: Stores sections for each game idea, including title and text
CREATE TABLE Sections (
    id              INT AUTO_INCREMENT PRIMARY KEY,                 -- sections id
    game_idea_id    INT,                                            -- game idea foreign key
    section_title   VARCHAR(100)    NOT NULL,                       -- Title of the section (Narrative, mechanics ect)
    section_text    TEXT            NOT NULL,                       -- section content
    FOREIGN KEY (game_idea_id) REFERENCES GameIdeas(id)             -- foreign key
);

-- SectionImages Table: Stores URLs for images associated with each section
CREATE TABLE SectionImages (
    id          INT AUTO_INCREMENT PRIMARY KEY,                     -- sectionImages id
    section_id  INT,                                                -- section foreign key
    image_url   TEXT NOT NULL,                                      -- URL to the section image
    FOREIGN KEY (section_id) REFERENCES Sections(id)                -- foreign key
);

-- Comments Table: Stores comments on game ideas
CREATE TABLE Comments (
    id              INT AUTO_INCREMENT PRIMARY KEY,                 -- comments id
    game_idea_id    INT,                                            -- game idea foreign key
    user_id         INT,                                            -- user foreign key
    comment_text    TEXT NOT NULL,                                  -- comment text
    comment_date    DATETIME DEFAULT CURRENT_TIMESTAMP,             -- date comment was made
    FOREIGN KEY (game_idea_id)  REFERENCES GameIdeas(id),           -- foreign key
    FOREIGN KEY (user_id)       REFERENCES Users(id)                -- foreign key
);