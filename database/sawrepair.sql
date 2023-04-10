/* MENAMBAHKAN TABEL BARU, TABEL DATA TYPE BATTERY */
/****** Object:  Table [dbo].[data_type_battery]    Script Date: 10/04/2023 10:16:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[data_type_battery](
	[id_type_battery] [int] IDENTITY(1,1) NOT NULL,
	[type_battery] [varchar](50) NULL,
 CONSTRAINT [PK_data_type_battery] PRIMARY KEY CLUSTERED 
(
	[id_type_battery] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/* MENAMBAHKAN TABEL BARU, TABEL SAW REPAIR */
/****** Object:  Table [dbo].[saw_repair]    Script Date: 10/04/2023 10:16:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[saw_repair](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[date] [date] NULL,
	[shift] [int] NULL,
 CONSTRAINT [PK_saw_repair] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/* MENAMBAHKAN TABEL BARU, TABEL SAW REPAIR POTONG INPUT */
/****** Object:  Table [dbo].[saw_repair_potong_input]    Script Date: 10/04/2023 10:16:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[saw_repair_potong_input](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[id_saw_repair] [int] NULL,
	[operator_potong] [nchar](10) NULL,
	[type_battery_potong] [varchar](50) NULL,
	[qty_element_potong] [int] NULL,
	[type_plate_reject_potong] [varchar](50) NULL,
	[qty_plate_reject_potong_kg] [int] NULL,
	[qty_plate_reject_potong_panel] [int] NULL,
	[keterangan_potong] [varchar](50) NULL,
 CONSTRAINT [PK_saw_repair_input] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/* MENAMBAHKAN TABEL BARU, TABEL SAW REPAIR SAW INPUT */
/****** Object:  Table [dbo].[saw_repair_saw_input]    Script Date: 10/04/2023 10:16:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[saw_repair_saw_input](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[id_saw_repair] [int] NULL,
	[operator_saw] [varchar](50) NULL,
	[type_battery_saw] [varchar](50) NULL,
	[qty_repair_saw] [int] NULL,
 CONSTRAINT [PK_saw_repair_saw_input] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/* MENAMBAHKAN DATA BARU PADA TABEL DATA TYPE BATTERY */
SET IDENTITY_INSERT [dbo].[data_type_battery] ON 

INSERT [dbo].[data_type_battery] ([id_type_battery], [type_battery]) VALUES (1, N'PF-CDPB-N50-09-INC-PPO-R')
INSERT [dbo].[data_type_battery] ([id_type_battery], [type_battery]) VALUES (2, N'PF-CDPW-N70-13-INC-PPO-R')
INSERT [dbo].[data_type_battery] ([id_type_battery], [type_battery]) VALUES (3, N'PF-HUPB-N50-08-INC-GLO-R')
INSERT [dbo].[data_type_battery] ([id_type_battery], [type_battery]) VALUES (4, N'PF-HUPB-N50Z10-INC-GLO-P')
INSERT [dbo].[data_type_battery] ([id_type_battery], [type_battery]) VALUES (5, N'PF-MWPD-MFN50-08-INC-MF6-P')
INSERT [dbo].[data_type_battery] ([id_type_battery], [type_battery]) VALUES (6, N'PF-HUPD-NS60-11-INC-GLO-P')
INSERT [dbo].[data_type_battery] ([id_type_battery], [type_battery]) VALUES (7, N'PF-CDPD-NS60-12-INC-PPO-K')
INSERT [dbo].[data_type_battery] ([id_type_battery], [type_battery]) VALUES (8, N'PF-MWPD-MFNS60-11-INC-MF6-P')
INSERT [dbo].[data_type_battery] ([id_type_battery], [type_battery]) VALUES (9, N'PF-HWPD-NS40ZL10-INC-GLO-P')
SET IDENTITY_INSERT [dbo].[data_type_battery] OFF
GO