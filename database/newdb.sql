/****** Object:  Table [dbo].[envelope]    Script Date: 28/03/2023 11:54:00 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[envelope](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[date] [date] NULL,
	[line] [int] NULL,
	[shift] [int] NULL,
	[team] [varchar](50) NULL,
	[status] [varchar](50) NULL,
 CONSTRAINT [PK_envelopenew_1] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[envelopeinput]    Script Date: 28/03/2023 11:54:00 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[envelopeinput](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[id_envelope] [int] NOT NULL,
	[plate] [varchar](50) NULL,
	[hasil_produksi] [int] NULL,
	[separator] [varchar](50) NULL,
	[melintir_bending] [float] NULL,
	[terpotong] [float] NULL,
	[rontok] [float] NULL,
	[tersangkut] [float] NULL,
	[persentase_reject_akumulatif] [varchar](50) NULL,
 CONSTRAINT [PK_envelopeinputnew_1] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[plate]    Script Date: 28/03/2023 11:54:00 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[plate](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[plate] [varchar](50) NOT NULL,
	[berat] [float] NOT NULL,
 CONSTRAINT [PK_platenew] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[platecutting]    Script Date: 28/03/2023 11:54:00 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[platecutting](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[date] [date] NOT NULL,
	[line] [int] NOT NULL,
	[shift] [int] NOT NULL,
	[team] [varchar](50) NOT NULL,
	[status] [varchar](50) NOT NULL,
 CONSTRAINT [PK_platecuttingnew] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[plateinput]    Script Date: 28/03/2023 11:54:00 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[plateinput](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[id_platecutting] [int] NULL,
	[plate] [varchar](50) NULL,
	[hasil_produksi] [int] NULL,
	[terpotong_panel] [float] NULL,
	[tersangkut_panel] [float] NULL,
	[overbrush_panel] [float] NULL,
	[rontok_panel] [float] NULL,
	[lug_patah_panel] [float] NULL,
	[patah_kaki_panel] [float] NULL,
	[patah_frame_panel] [float] NULL,
	[bolong_panel] [float] NULL,
	[bending_panel] [float] NULL,
	[lengket_terpotong_panel] [float] NULL,
	[terpotong_kg] [float] NULL,
	[tersangkut_kg] [float] NULL,
	[overbrush_kg] [float] NULL,
	[rontok_kg] [float] NULL,
	[lug_patah_kg] [float] NULL,
	[patah_kaki_kg] [float] NULL,
	[patah_frame_kg] [float] NULL,
	[bolong_kg] [float] NULL,
	[bending_kg] [float] NULL,
	[lengket_terpotong_kg] [float] NULL,
	[persentase_reject_internal] [varchar](50) NULL,
	[persentase_reject_eksternal] [varchar](50) NULL,
	[persentase_reject_akumulatif] [varchar](50) NULL,
 CONSTRAINT [PK_plateinput] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[separator]    Script Date: 28/03/2023 11:54:00 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[separator](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[separator] [varchar](50) NULL,
 CONSTRAINT [PK_separatornew] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[team]    Script Date: 28/03/2023 11:54:00 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[team](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[team] [varchar](50) NULL,
 CONSTRAINT [PK_teamnew] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[plate] ON 

INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (1, N'CG79POS', 0.3161)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (2, N'CG79POS-UF', 0.3161)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (3, N'CG80POS', 0.28215)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (4, N'CG80POS-UF', 0.28215)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (5, N'CG82POS', 0.25093)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (6, N'CG82POS-UF', 0.25093)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (7, N'CG84NEG', 0.2556)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (8, N'CG84NEG-UF', 0.25202)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (9, N'CG85DNEG', 0.24202)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (10, N'CG85DPOS-UF', 0.24202)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (11, N'CG85EPOS-UF', 0.2372)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (12, N'CG85NEG', 0.24202)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (13, N'CG85NEG-UF', 0.24202)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (14, N'CG85POS', 0.24202)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (15, N'CG85POS-UF', 0.24202)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (16, N'CG87NEG', 0.20683)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (17, N'CG87NEG-UF', 0.20683)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (18, N'CM84POS', 0.17637)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (19, N'CM84POS-UF', 0.17637)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (20, N'CM87NEG', 0.16258)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (21, N'CM87NEG-UF', 0.16258)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (22, N'CR82POS', 0.22368)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (23, N'CR82POS-UF', 0.22368)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (24, N'CR87NEG', 0.18346)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (25, N'CR87NEG-UF', 0.18346)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (26, N'DF72POS', 0.447)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (27, N'DF72POS-UF', 0.447)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (28, N'DF78NEG', 0.32913)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (29, N'DF78NEG-UF', 0.32913)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (30, N'WG83POS-UF', 0.14308)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (31, N'WG87NEG-UF', 0.11221)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (32, N'WM84ESPOS-UF', 0.102)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (33, N'WM84POS-UF', 0.102)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (34, N'WM85NEG-UF', 0.087)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (35, N'WM87ESNEG-UF', 0.102)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (36, N'YA82POS-UF', 0.32267)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (37, N'YA85NEG', 0.291)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (38, N'YA85NEG-UF', 0.291)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (39, N'YC62POS-UF', 0.705)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (40, N'YC70NEG-UF', 0.545)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (41, N'YD85POS', 0.23826)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (42, N'YD85POS-UF', 0.23826)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (43, N'YG79HDPOS-UF', 0.3173)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (44, N'YG79POS-UF', 0.29776)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (45, N'YG80POS-UF', 0.29776)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (46, N'YG82HDPOS-UF', 0.28257)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (47, N'YG82POS-UF', 0.26557)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (48, N'YG85NEG-UF', 0.25087)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (49, N'YG85POS-UF', 0.25087)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (50, N'YG87NEG-UF', 0.21983)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (51, N'YL80POS-UF', 0.17488)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (52, N'YL84NEG-UF', 0.156)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (53, N'YM84NEG-UF', 0.2058)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (54, N'YT71POS-UF', 0.467)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (55, N'YT80NEG-UF', 0.314)
INSERT [dbo].[plate] ([id], [plate], [berat]) VALUES (56, N'YT80POS-UF', 0.314)
SET IDENTITY_INSERT [dbo].[plate] OFF
GO
SET IDENTITY_INSERT [dbo].[separator] ON 

INSERT [dbo].[separator] ([id], [separator]) VALUES (1, N'PE-0.75R10')
INSERT [dbo].[separator] ([id], [separator]) VALUES (2, N'PE-06R13')
INSERT [dbo].[separator] ([id], [separator]) VALUES (3, N'PE-08R4')
INSERT [dbo].[separator] ([id], [separator]) VALUES (4, N'PE-10R2')
INSERT [dbo].[separator] ([id], [separator]) VALUES (5, N'PE-10R4')
INSERT [dbo].[separator] ([id], [separator]) VALUES (6, N'PE-10R5')
INSERT [dbo].[separator] ([id], [separator]) VALUES (7, N'PE-GM')
SET IDENTITY_INSERT [dbo].[separator] OFF
GO
SET IDENTITY_INSERT [dbo].[team] ON 

INSERT [dbo].[team] ([id], [team]) VALUES (1, N'AGUNG. K')
INSERT [dbo].[team] ([id], [team]) VALUES (2, N'ASEP DIDING')
INSERT [dbo].[team] ([id], [team]) VALUES (3, N'HARIS SUKISNO')
INSERT [dbo].[team] ([id], [team]) VALUES (4, N'HARIYONO')
INSERT [dbo].[team] ([id], [team]) VALUES (5, N'KOKO HARTOYO')
INSERT [dbo].[team] ([id], [team]) VALUES (6, N'M. ARDIANSYAH')
INSERT [dbo].[team] ([id], [team]) VALUES (7, N'RIAN ARYADI')
INSERT [dbo].[team] ([id], [team]) VALUES (8, N'RIFQY AKBAR')
INSERT [dbo].[team] ([id], [team]) VALUES (9, N'WAHYUDI')
SET IDENTITY_INSERT [dbo].[team] OFF
GO